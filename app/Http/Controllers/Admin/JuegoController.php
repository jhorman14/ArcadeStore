<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Juego;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\JuegoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
class JuegoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $juegos = Juego::all();
        return view('admin.juegos.index', compact('juegos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.juegos.create');
    }

    /**
     * Store a newly created resource in storage.
     */

public function store(Request $request)
{
    $request->validate([
        'titulo' => 'required|string|max:50',
        'precio' => 'required|numeric|min:0',
        'descripcion' => 'nullable|string',
        'requisitos_minimos' => 'nullable|string',
        'requisitos_recomendados' => 'nullable|string',
        'id_categoria' => 'required|exists:categorias,id_categoria',
        'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación de la imagen
    ]);

    $imagenPath = $request->file('imagen')->store('public/images');
    $imagenNombre = basename($imagenPath);

    Juego::create([
        'titulo' => $request->titulo,
        'precio' => $request->precio,
        'descripcion' => $request->descripcion,
        'requisitos_minimos' => $request->requisitos_minimos,
        'requisitos_recomendados' => $request->requisitos_recomendados,
        'id_categoria' => $request->id_categoria,
        'imagen' => $imagenNombre, // Guarda el nombre del archivo en la base de datos
    ]);

    return redirect()->route('admin.juegos.index')->with('success', 'Juego creado exitosamente.');
}

    /**
     * Show the form for editing the specified resource.
     */
    public function show($id): View
    {
        $juego = Juego::find($id);

        return view('admin.juego.show', compact('juego'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $juego = Juego::find($id);

        return view('adminjuego.edit', compact('juego'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JuegoRequest $request, Juego $juego): RedirectResponse
    {
        $juego->update($request->validated());

        return Redirect::route('admin.juegos.index')
            ->with('success', 'Juego updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Juego::find($id)->delete();

        return Redirect::route('admin.juegos.index')
            ->with('success', 'Juego deleted successfully');
    }
}
