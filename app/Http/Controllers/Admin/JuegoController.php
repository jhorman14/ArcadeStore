<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Juego;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\JuegoRequest;
use App\Models\Categoria;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class JuegoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $juegos = Juego::paginate(10); // Paginando 10 resultados por página
        return view('admin.juego.index', compact('juegos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();

        return view('admin.juego.create', compact('categorias'));
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
            'id_categoria' => 'required|exists:categorias,id',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación de la imagen
        ]);

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = $imagen->getClientOriginalName(); // Usar el nombre original del archivo
            $moved = $imagen->move(public_path('images'), $nombreImagen);

            if (!$moved) {
                // Algo salió mal al mover el archivo
                dd('Error al mover el archivo');
            }

            Juego::create([
                'titulo' => $request->titulo,
                'precio' => $request->precio,
                'descripcion' => $request->descripcion,
                'requisitos_minimos' => $request->requisitos_minimos,
                'requisitos_recomendados' => $request->requisitos_recomendados,
                'id_categoria' => $request->id_categoria,
                'imagen' => $nombreImagen, // Guarda el nombre original del archivo en la base de datos
            ]);

            return redirect()->route('admin.juegos.index')->with('success', 'Juego creado exitosamente.');
        } else {
            // La imagen no fue subida, pero la validación debería haber fallado
            return redirect()->back()->withErrors(['imagen' => 'La imagen es requerida.']);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Juego $juego)
    {
        $categorias = Categoria::all(); // Fetch all categories from the database

        return view('admin.juego.edit', compact('juego', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Juego $juego): RedirectResponse
    {
        $request->validate([
            'titulo' => 'required|string|max:50',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
            'requisitos_minimos' => 'nullable|string',
            'requisitos_recomendados' => 'nullable|string',
            'id_categoria' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación de la imagen (opcional)
        ]);

        $dataToUpdate = $request->except(['_token', '_method', 'imagen']);

        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($juego->imagen) {
                Storage::delete('public/images/' . $juego->imagen);
            }

            $imagen = $request->file('imagen');
            $nombreImagen = $imagen->getClientOriginalName(); // Usar el nombre original del archivo
            $imagen->move(public_path('images'), $nombreImagen);
            $dataToUpdate['imagen'] = $nombreImagen;
        }

        $juego->update($dataToUpdate);

        return Redirect::route('admin.juegos.index')
            ->with('success', 'Juego actualizado exitosamente');
    }

    public function destroy($id): RedirectResponse
    {
        $juego = Juego::find($id);

        if ($juego) {
            // Desactivar el juego en lugar de eliminarlo
            $juego->activo = !$juego->activo; // Asumiendo que tienes un campo 'activo' en tu modelo Juego
            $juego->save();

            return Redirect::route('admin.juegos.index')
                ->with('success', 'Juego desactivado exitosamente.');
        } else {
            return Redirect::route('admin.juegos.index')
                ->with('error', 'Juego no encontrado.');
        }
    }
}
