<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Juego;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class CategoriaController extends Controller
{
    public function index(Request $request): View
    {
        $categorias = Categoria::paginate(10);

        return view('categoria.index', compact('categorias'))
            ->with('i', ($request->input('page', 1) - 1) * $categorias->perPage());
    }

    public function create(): View
    {
        $categoria = new Categoria();
        return view('categoria.create', compact('categoria'));
    }

    public function store(CategoriaRequest $request): RedirectResponse
    {
        Categoria::create($request->validated());

        return Redirect::route('categorias.index')
            ->with('success', 'Categoria created successfully.');
    }

    public function edit($id): View
    {
        $categoria = Categoria::find($id);
        return view('categoria.edit', compact('categoria'));
    }

    public function update(CategoriaRequest $request, Categoria $categoria): RedirectResponse
    {
        $categoria->update($request->validated());

        return Redirect::route('categorias.index')
            ->with('success', 'Categoria updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        $categoria = Categoria::find($id);

        if ($categoria) {
            // Obtener el nuevo estado
            $nuevoEstado = !$categoria->activo;
            
            // Cambiar el estado de la categoría
            $categoria->activo = $nuevoEstado;
            $categoria->save();

            // Solo desactivar los juegos si la categoría se está desactivando
            if (!$nuevoEstado) {
                Juego::where('id_categoria', $categoria->id)
                    ->update(['activo' => false]);
                $mensaje = 'Categoria y sus juegos desactivados exitosamente.';
            } else {
                $mensaje = 'Categoria activada exitosamente.';
            }

            return redirect()->route('categorias.index')
                ->with('success', $mensaje);
        }

        return redirect()->route('categorias.index')
            ->with('error', 'Categoria no encontrada.');
    }
}
