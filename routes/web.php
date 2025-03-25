<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ConvenioController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\IntercambioController;
use App\Http\Controllers\JuegoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('tienda.index');
});

Route::get('/biblioteca', function () {
    return view('tienda.juegos');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas para el perfil de usuario (protegidas)
Route::middleware('auth')->group(function () {
    Route::get('/profile/{id}', [UserController::class, 'show'])->name('profile.show');
    Route::get('/profile/{id}/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/deactivate', [UserController::class, 'deactivateAccount'])->name('profile.deactivate');
});

// Rutas para los recursos (CRUD)
Route::resource('pedidos', PedidoController::class)->middleware('auth');
Route::resource('pagos', PagoController::class)->middleware('auth');
Route::resource('convenios', ConvenioController::class)->middleware('auth');
Route::resource('ventas', VentaController::class)->middleware('auth');
Route::resource('intercambios', IntercambioController::class)->middleware('auth');
Route::resource('juegos', JuegoController::class); // Puedes decidir si requiere autenticación
Route::resource('inventarios', InventarioController::class)->middleware('auth');
Route::resource('categorias', CategoriaController::class); // Puedes decidir si requiere autenticación

// Rutas de administración (ejemplo, necesitarás ajustar el middleware)
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('users', Admin\UserController::class)->except(['show']);
});