<?php

namespace App\Http\Controllers;

use App\Models\Intercambio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\IntercambioRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class IntercambioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $intercambios = Intercambio::paginate();

        return view('intercambio.index', compact('intercambios'))
            ->with('i', ($request->input('page', 1) - 1) * $intercambios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $intercambio = new Intercambio();

        return view('intercambio.create', compact('intercambio'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IntercambioRequest $request): RedirectResponse
    {
        Intercambio::create($request->validated());

        return Redirect::route('intercambios.index')
            ->with('success', 'Intercambio created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $intercambio = Intercambio::find($id);

        return view('intercambio.show', compact('intercambio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $intercambio = Intercambio::find($id);

        return view('intercambio.edit', compact('intercambio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IntercambioRequest $request, Intercambio $intercambio): RedirectResponse
    {
        $intercambio->update($request->validated());

        return Redirect::route('intercambios.index')
            ->with('success', 'Intercambio updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Intercambio::find($id)->delete();

        return Redirect::route('intercambios.index')
            ->with('success', 'Intercambio deleted successfully');
    }
}
