<?php

use App\Http\Controllers\ContactoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ConvenioController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\IntercambioController;
use App\Http\Controllers\JuegoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\Admin\JuegoController as AdminJuegoController;
use App\Http\Controllers\Admin\UserController as AdminUserController; // Agrega esta línea
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
    return view('tienda.index');
})->name('inicio');
Route::get('/juegosDisp', function () {
    return view('tienda.juegos');
});
Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::post('/enviar-mensaje', [ContactoController::class, 'enviarMensaje'])->name('enviar.mensaje');

Route::get('/juegosDisp', [JuegoController::class, 'index'])->name('juegosDisp');
Route::get('/juegosDisp/{juego}', [JuegoController::class, 'show'])->name('tienda.show');
Route::get('/juegos-gratis', [JuegoController::class, 'juegosGratis'])->name('tienda.juegos-gratis');

Auth::routes();

// Rutas para el perfil de usuario (protegidas)
Route::middleware('auth')->group(function () {
    Route::get('/pedidos/create/{juego_id}', [PedidoController::class, 'create'])->name('pedidos.create');
    Route::get('/profile/{id}', [UserController::class, 'show'])->name('profile.show');
    Route::get('/profile/{id}/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/deactivate', [UserController::class, 'deactivateAccount'])->name('profile.deactivate');
    Route::get('/pedidos/create/{juego_id?}', [PedidoController::class, 'create'])->name('pedidos.create');
    Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedido.store');
    Route::get('/pedidos/gracias/{pedido}', [PedidoController::class, 'gracias'])->name('pedido.gracias');
    Route::get('/pedidos/{pedido}', [PedidoController::class, 'show'])->name('pedidos.show');
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
});

// Rutas para los recursos (CRUD)
Route::resource('pagos', PagoController::class)->middleware('auth');

Route::resource('ventas', VentaController::class)->middleware('auth');
Route::resource('intercambios', IntercambioController::class)->middleware('auth');

Route::post('/inventario/reducir-stock', [InventarioController::class, 'reducirStock'])->name('inventario.reducir-stock');



Route::prefix('categorias')->name('categorias.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [CategoriaController::class, 'index'])->name('index');
    Route::get('/create', [CategoriaController::class, 'create'])->name('create');
    Route::post('/', [CategoriaController::class, 'store'])->name('store');
    Route::get('/{categoria}/edit', [CategoriaController::class, 'edit'])->name('edit');
    Route::put('/{categoria}', [CategoriaController::class, 'update'])->name('update');
    Route::delete('/{categoria}', [CategoriaController::class, 'destroy'])->name('destroy');
});



Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('juegos', AdminJuegoController::class);
    Route::get('/dashboard', function () {
        return view('tienda.dashboard');})->name('admin.dashboard'); // Asigna un nombre a la ruta del dashboard
    Route::resource('convenios', ConvenioController::class);
    Route::resource('users', AdminUserController::class); // Agrega las rutas para el controlador de usuarios de admin
    
});

// Rutas para admin/juegos - Usando el controlador AdminJuegoController
Route::prefix('admin/juegos')->name('admin.juegos.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminJuegoController::class, 'index'])->name('index');
    Route::get('/crear', [AdminJuegoController::class, 'create'])->name('crear');
    Route::post('/store', [AdminJuegoController::class, 'store'])->name('store');
    Route::get('/{juego}/editar', [AdminJuegoController::class, 'edit'])->name('editar');
    Route::put('/{juego}', [AdminJuegoController::class, 'update'])->name('update');
    Route::delete('/juegos/{juego}', [AdminJuegoController::class, 'destroy'])->name('juegos.destroy');
});

// Rutas para admin/users - Usando el controlador AdminUserController
Route::prefix('admin/users')->name('admin.users.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminUserController::class, 'index'])->name('index');
    Route::get('/create', [AdminUserController::class, 'create'])->name('create');
    Route::post('/', [AdminUserController::class, 'store'])->name('store');
    Route::get('/{user}/edit', [AdminUserController::class, 'edit'])->name('edit');
    Route::put('/{user}', [AdminUserController::class, 'update'])->name('update');
    Route::delete('/{user}', [AdminUserController::class, 'destroy'])->name('destroy');
    Route::put('/{user}/change-role', [AdminUserController::class, 'changeRole'])->name('change-role');
});


