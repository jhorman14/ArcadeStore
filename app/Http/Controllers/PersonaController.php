<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PersonaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $personas = Persona::paginate();

        return view('persona.index', compact('personas'))
            ->with('i', ($request->input('page', 1) - 1) * $personas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $persona = new Persona();

        return view('persona.create', compact('persona'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PersonaRequest $request): RedirectResponse
    {
        Persona::create($request->validated());

        return Redirect::route('personas.index')
            ->with('success', 'Persona created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $persona = Persona::find($id);

        return view('persona.show', compact('persona'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $persona = Persona::find($id);

        return view('persona.edit', compact('persona'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PersonaRequest $request, Persona $persona): RedirectResponse
    {
        $persona->update($request->validated());

        return Redirect::route('personas.index')
            ->with('success', 'Persona updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Persona::find($id)->delete();

        return Redirect::route('personas.index')
            ->with('success', 'Persona deleted successfully');
    }
}
