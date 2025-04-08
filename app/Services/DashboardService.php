<?php

namespace App\Services;

use App\Models\User;
use App\Models\Order;
use App\Models\Juego;
use App\Models\Intercambio;
use Carbon\Carbon;

class DashboardService
{
    public function getStats()
    {
        $totalUsers = User::count();
        $totalGamesSold = Order::sum('cantidad');
        $totalIntercambios = Intercambio::count();
        $totalGames = Juego::count();

        // Calculate the percentage of games sold
        $percentageGamesSold = 0;
        if ($totalGames > 0) {
            $percentageGamesSold = ($totalGamesSold / $totalGames) * 100;
        }

        return [
            'total_users' => $totalUsers,
            'total_games_sold' => $totalGamesSold,
            'total_intercambios' => $totalIntercambios,
            'total_games' => $totalGames,
            'percentage_games_sold' => round($percentageGamesSold, 2), // Add the percentage to the stats, rounded to 2 decimals
        ];
    }
}
