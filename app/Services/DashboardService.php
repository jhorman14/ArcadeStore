<?php

namespace App\Services;

use App\Models\User;
use App\Models\Order; // Use the Order model
use App\Models\Juego;
use Carbon\Carbon;

class DashboardService
{
    public function getStats()
    {
        $totalUsers = User::count();
        // Assuming you have a 'cantidad' column in the 'pedidos' table
        $totalGamesSold = Order::sum('cantidad'); // Use 'cantidad' instead of 'quantity'

        return [
            'total_users' => $totalUsers,
            'total_games_sold' => $totalGamesSold,
        ];
    }
}
