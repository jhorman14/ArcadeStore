<?php

namespace App\Http\Controllers;

use App\Models\Convenio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ConvenioRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ConvenioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $convenios = Convenio::paginate();

        return view('convenio.index', compact('convenios'))
            ->with('i', ($request->input('page', 1) - 1) * $convenios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $convenio = new Convenio();

        return view('convenio.create', compact('convenio'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ConvenioRequest $request): RedirectResponse
    {
        Convenio::create($request->validated());

        return Redirect::route('convenios.index')
            ->with('success', 'Convenio created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $convenio = Convenio::find($id);

        return view('convenio.show', compact('convenio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $convenio = Convenio::find($id);

        return view('convenio.edit', compact('convenio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ConvenioRequest $request, Convenio $convenio): RedirectResponse
    {
        $convenio->update($request->validated());

        return Redirect::route('convenios.index')
            ->with('success', 'Convenio updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Convenio::find($id)->delete();

        return Redirect::route('convenios.index')
            ->with('success', 'Convenio deleted successfully');
    }
}
