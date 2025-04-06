<?php

namespace App\Http\Controllers;

use App\Models\Juego;
use App\Models\Categoria;
use Illuminate\View\View;
use Illuminate\Http\Request;

class JuegoController extends Controller
{
    /**
     * Display a listing of the resource in the tienda.juegos view.
     */
    public function index(Request $request): View
    {
        $query = Juego::query()->where('activo', true);
        $adquiridosQuery = null;
        $juegosAdquiridosIds = [];
        $juegosAdquiridos = collect(); // Initialize as an empty Collection

        if (auth()->check()) {
            $juegosAdquiridos = auth()->user()->juegosComprados;
            $juegosAdquiridosIds = $juegosAdquiridos->pluck('id')->toArray();
            $adquiridosQuery = auth()->user()->juegosComprados()->getQuery();

            // Filtrado por categoría para Juegos Adquiridos
            if ($request->has('categoria') && $request->input('categoria') != '') {
                $adquiridosQuery->where('id_categoria', $request->input('categoria'));
            }

            // Búsqueda por término para Juegos Adquiridos
            if ($request->has('q') && $adquiridosQuery !== null) {
                $searchTerm = $request->input('q');
                $adquiridosQuery->where(function ($q) use ($searchTerm) {
                    $q->where('titulo', 'like', '%' . $searchTerm . '%')
                        ->orWhere('descripcion', 'like', '%' . $searchTerm . '%');
                });
            }

            $juegosAdquiridos = $adquiridosQuery->get();
        }

        // Filtrado por categoría para Juegos Disponibles
        if ($request->has('categoria') && $request->input('categoria') != '') {
            $query->where('id_categoria', $request->input('categoria'));
        }

        // Búsqueda por término para Juegos Disponibles
        if ($request->has('q')) {
            $searchTerm = $request->input('q');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('titulo', 'like', '%' . $searchTerm . '%')
                    ->orWhere('descripcion', 'like', '%' . $searchTerm . '%');
                });
            }
        

        // Excluir juegos adquiridos de la lista de Juegos Disponibles
        if (!empty($juegosAdquiridosIds)) {
            $query->whereNotIn('id', $juegosAdquiridosIds);
        }

        $juegos = $query->paginate(12)->withQueryString();
        $categorias = Categoria::all();

        return view('tienda.juegos', compact('juegos', 'juegosAdquiridos', 'categorias'));
    }
    public function show($id): View
    {
        $juego = Juego::findOrFail($id);
        $comprado = false;
        if (auth()->check()) {
            $comprado = auth()->user()->juegosComprados()->where('juegos.id', $juego->id)->exists();
        }
        return view('tienda.show', compact('juego', 'comprado'));
    }

    public function juegosGratis(Request $request): View
    {
        $query = Juego::query()->where('precio', 0);

        // Filtrado por categoría
        if ($request->has('categoria') && $request->input('categoria') != '') {
            $query->where('id_categoria', $request->input('categoria'));
        }

        // Búsqueda por término
        if ($request->has('q') && $request->input('q') != '') {
            $searchTerm = $request->input('q');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('titulo', 'like', '%' . $searchTerm . '%')
                    ->orWhere('descripcion', 'like', '%' . $searchTerm . '%');
            });
        }

        $juegosGratis = $query->paginate(12)->withQueryString();
        $categorias = Categoria::all(); // Necesitas pasar las categorías para el filtro

        return view('tienda.juegos-gratis', compact('juegosGratis', 'categorias'));
    }
}