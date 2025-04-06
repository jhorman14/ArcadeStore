<?php

namespace App\Http\Controllers;

use App\Models\Juego; // Asegúrate de importar tu modelo Juego
use Illuminate\View\View;

class InicioController extends Controller
{
    public function index(): View
    {
        // Obtén los juegos que quieres mostrar en la página de inicio
        // Puedes usar diferentes criterios (los más recientes, destacados, etc.)
        $juegosDestacados = Juego::where('destacado', true)->where('activo', true)->with('categoria')->take(4)->get();
        $juegosRecientes = Juego::where('activo', true)->orderBy('created_at', 'desc')->take(3)->get(); // Ejemplo: 3 juegos más recientes

        // Pasa los juegos a la vista
        return view('tienda.index', compact('juegosDestacados', 'juegosRecientes'));
        // Asumiendo que tu vista de inicio se llama 'welcome.blade.php'
    }
}
