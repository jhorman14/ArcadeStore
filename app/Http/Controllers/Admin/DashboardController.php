<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use App\Models\Intercambio;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        // Puedes pasar las estadísticas a la vista si quieres una carga inicial
        $stats = $this->dashboardService->getStats();
        return view('tienda.dashboard', compact('stats')); // Cambiado a tienda.dashboard
    }

    public function getStats()
    {
        $stats = $this->dashboardService->getStats();
        return response()->json($stats);
    }
    public function IntercambiosDashboard(Request $request)
{
    $search = $request->input('search');
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    $intercambios = Intercambio::with(['usuario', 'juegoSolicitado', 'juegoOfrecido'])
        ->when($search, function ($query, $search) {
            return $query->whereHas('usuario', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            })->orWhereHas('juegoSolicitado', function ($q) use ($search) {
                $q->where('titulo', 'like', '%' . $search . '%');
            })->orWhereHas('juegoOfrecido', function ($q) use ($search) {
                $q->where('titulo', 'like', '%' . $search . '%');
            });
        })
        ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
            return $query->whereBetween('fecha_intercambio', [$startDate, $endDate]);
        })
        ->orderBy('fecha_intercambio', 'desc')
        ->paginate(10);

    return view('tienda.intercambios', compact('intercambios'));
}

}
