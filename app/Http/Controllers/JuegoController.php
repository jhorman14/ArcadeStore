<?php

namespace App\Http\Controllers;

use App\Models\Juego;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JuegoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $juegos = Juego::all(); // Obtiene todos los juegos de la base de datos
        return view('tienda.juegos', compact('juegos'));
    }

    public function show($id): View
    {
        $juego = Juego::find($id);

        return view('juegos.show', compact('juego'));
    }
}
