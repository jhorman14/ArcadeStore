<?php

namespace App\Http\Controllers;

use App\Models\Convenio;
use Illuminate\Http\Request;

class ConvenioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $convenios = Convenio::all();
        return view('convenios.index', compact('convenios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('convenios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:200',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after:fecha_inicio',
            'id_usuario' => 'required|exists:users,id',
            'id_juego' => 'required|exists:juegos,id_juego',
        ]);

        Convenio::create($request->all());

        return redirect()->route('convenios.index')->with('success', 'Convenio creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Convenio $convenio)
    {
        $convenio->load('usuario', 'juego');
        return view('convenios.show', compact('convenio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Convenio $convenio)
    {
        return view('convenios.edit', compact('convenio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Convenio $convenio)
    {
        $request->validate([
            'descripcion' => 'required|string|max:200',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after:fecha_inicio',
            'id_usuario' => 'required|exists:users,id',
            'id_juego' => 'required|exists:juegos,id_juego',
        ]);

        $convenio->update($request->all());

        return redirect()->route('convenios.index')->with('success', 'Convenio actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Convenio $convenio)
    {
        $convenio->delete();

        return redirect()->route('convenios.index')->with('success', 'Convenio eliminado exitosamente.');
    }
}