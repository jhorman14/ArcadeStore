<?php

namespace App\Http\Controllers;

use App\Models\Intercambio;
use Illuminate\Http\Request;

class IntercambioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $intercambios = Intercambio::all();
        return view('intercambios.index', compact('intercambios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('intercambios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'estado_intercambio' => 'required|string|max:100',
            'fecha_intercambio' => 'required|date',
            'id_productosolicitado' => 'required|exists:juegos,id_juego',
            'id_productoofrecido' => 'required|exists:juegos,id_juego',
        ]);

        Intercambio::create($request->all());

        return redirect()->route('intercambios.index')->with('success', 'Intercambio creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Intercambio $intercambio)
    {
        $intercambio->load('productoSolicitado', 'productoOfrecido');
        return view('intercambios.show', compact('intercambio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Intercambio $intercambio)
    {
        return view('intercambios.edit', compact('intercambio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Intercambio $intercambio)
    {
        $request->validate([
            'estado_intercambio' => 'required|string|max:100',
            'fecha_intercambio' => 'required|date',
            'id_productosolicitado' => 'required|exists:juegos,id_juego',
            'id_productoofrecido' => 'required|exists:juegos,id_juego',
        ]);

        $intercambio->update($request->all());

        return redirect()->route('intercambios.index')->with('success', 'Intercambio actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Intercambio $intercambio)
    {
        $intercambio->delete();

        return redirect()->route('intercambios.index')->with('success', 'Intercambio eliminado exitosamente.');
    }
}