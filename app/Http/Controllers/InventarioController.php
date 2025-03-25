<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventarios = Inventario::all();
        return view('inventarios.index', compact('inventarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'stock' => 'required|integer|min:0',
            'id_juego' => 'required|exists:juegos,id_juego',
        ]);

        Inventario::create($request->all());

        return redirect()->route('inventarios.index')->with('success', 'Inventario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventario $inventario)
    {
        $inventario->load('juego');
        return view('inventarios.show', compact('inventario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventario $inventario)
    {
        return view('inventarios.edit', compact('inventario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventario $inventario)
    {
        $request->validate([
            'stock' => 'required|integer|min:0',
            'id_juego' => 'required|exists:juegos,id_juego',
        ]);

        $inventario->update($request->all());

        return redirect()->route('inventarios.index')->with('success', 'Inventario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventario $inventario)
    {
        $inventario->delete();

        return redirect()->route('inventarios.index')->with('success', 'Inventario eliminado exitosamente.');
    }
}