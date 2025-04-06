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

    $juegos = $query->paginate(12)->withQueryString();
    $categorias = Categoria::all();
    $juegosAdquiridos = [];

    if (auth()->check()) {
        $juegosAdquiridos = auth()->user()->juegosComprados;
    }

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

    public function juegosGratis(): View
    {
        $juegosGratis = Juego::where('precio', 0)->get();
        return view('tienda.juegos-gratis', compact('juegosGratis'));
    }
}