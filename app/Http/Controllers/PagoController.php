<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\PagoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource (para administradores).
     */
    public function index(Request $request): View
    {
        $pagos = Pago::paginate();

        return view('admin.pagos.index', compact('pagos')) // Asegúrate de tener una vista para administradores
            ->with('i', ($request->input('page', 1) - 1) * $pagos->perPage());
    }

    /**
     * Show the form for creating a new resource (para administradores).
     */
    public function create(): View
    {
        $pago = new Pago();
        return view('admin.pagos.create', compact('pago'));
    }

    /**
     * Store a newly created resource in storage (para administradores).
     */
    public function store(PagoRequest $request): RedirectResponse
    {
        Pago::create($request->validated());

        return Redirect::route('admin.pagos.index')
            ->with('success', 'Pago creado successfully.');
    }

    /**
     * Display the specified resource (para administradores).
     */
    public function show(Pago $pago): View
    {
        return view('admin.pagos.show', compact('pago'));
    }

    /**
     * Show the form for editing the specified resource (para administradores).
     */
    public function edit(Pago $pago): View
    {
        return view('admin.pagos.edit', compact('pago'));
    }

    /**
     * Update the specified resource in storage (para administradores).
     */
    public function update(PagoRequest $request, Pago $pago): RedirectResponse
    {
        $pago->update($request->validated());

        return Redirect::route('admin.pagos.index')
            ->with('success', 'Pago updated successfully');
    }

    /**
     * Remove the specified resource from storage (para administradores).
     */
    public function destroy(Pago $pago): RedirectResponse
    {
        $pago->delete();

        return Redirect::route('admin.pagos.index')
            ->with('success', 'Pago deleted successfully');
    }
}