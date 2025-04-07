<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\VentaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Carbon\Carbon;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $ventas = Venta::with(['user', 'juego', 'pedido'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                })->orWhereHas('juego', function ($q) use ($search) {
                    $q->where('titulo', 'like', '%' . $search . '%');
                });
            })
            ->when($startDate, function ($query, $startDate) {
                $query->where('fecha_venta', '>=', Carbon::parse($startDate)->startOfDay());
            })
            ->when($endDate, function ($query, $endDate) {
                $query->where('fecha_venta', '<=', Carbon::parse($endDate)->endOfDay());
            })
            ->paginate(10)
            ->appends($request->query()); // Mantener los filtros en la paginación

        return view('venta.index', compact('ventas'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $venta = new Venta();

        return view('venta.create', compact('venta'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VentaRequest $request): RedirectResponse
    {
        Venta::create($request->validated());

        return Redirect::route('ventas.index')
            ->with('success', 'Venta created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $venta = Venta::with(['juego', 'user', 'pedido'])->find($id);

        // Manejo si la venta no se encuentra
        if (!$venta) {
            abort(404, 'Venta no encontrada.');
        }

        return view('venta.show', compact('venta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $venta = Venta::with(['juego', 'user', 'pedido'])->find($id);

         // Manejo si la venta no se encuentra
        if (!$venta) {
            abort(404, 'Venta no encontrada.');
        }
        
        return view('venta.edit', compact('venta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VentaRequest $request, Venta $venta): RedirectResponse
    {
        $venta->update($request->validated());

        return Redirect::route('ventas.index')
            ->with('success', 'Venta updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Venta::find($id)->delete();

        return Redirect::route('ventas.index')
            ->with('success', 'Venta deleted successfully');
    }
}
