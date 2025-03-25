<?php

namespace App\Http\Controllers;

use App\Models\Juego;
use Illuminate\Http\Request;

class JuegoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $juegos = Juego::all();
        return view('juegos.index', compact('juegos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('juegos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:50',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
            'requisitos_minimos' => 'nullable|string',
            'requisitos_recomendados' => 'nullable|string',
            'id_categoria' => 'required|exists:categorias,id_categoria',
        ]);

        Juego::create($request->all());

        return redirect()->route('juegos.index')->with('success', 'Juego creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Juego $juego)
    {
        $juego->load('categoria', 'pedidos', 'convenios', 'ventas', 'inventario', 'intercambiosSolicitados', 'intercambiosOfrecidos');
        return view('juegos.show', compact('juego'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Juego $juego)
    {
        return view('juegos.edit', compact('juego'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Juego $juego)
    {
        $request->validate([
            'titulo' => 'required|string|max:50',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
            'requisitos_minimos' => 'nullable|string',
            'requisitos_recomendados' => 'nullable|string',
            'id_categoria' => 'required|exists:categorias,id_categoria',
        ]);

        $juego->update($request->all());

        return redirect()->route('juegos.index')->with('success', 'Juego actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Juego $juego)
    {
        $juego->delete();

        return redirect()->route('juegos.index')->with('success', 'Juego eliminado exitosamente.');
    }
}