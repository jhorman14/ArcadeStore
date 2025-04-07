<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

// ... otras rutas ...

Route::get('/admin/stats', [DashboardController::class, 'getStats']);
