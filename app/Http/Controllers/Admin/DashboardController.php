<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;

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
}
