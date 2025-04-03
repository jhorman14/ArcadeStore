<?php

namespace App\Http\Controllers;

use App\Models\Juego;
use Illuminate\View\View;

class JuegoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $juegos = Juego::all(); // Obtiene todos los juegos de la base de datos
        $juegosAdquiridos = []; // Inicializamos la variable como un array vacío

        // Obtener juegos adquiridos si el usuario está autenticado
        if (auth()->check()) {
            $juegosAdquiridos = auth()->user()->juegosComprados;
        }

        return view('tienda.juegos', compact('juegos', 'juegosAdquiridos'));

    }

    public function show($id): View
    {
        $juego = Juego::findOrFail($id);

        // Verificar si el usuario ha comprado el juego
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