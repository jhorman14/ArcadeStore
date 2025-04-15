<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Juego;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\JuegoRequest;
use App\Models\Categoria;
use App\Models\Inventario;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class JuegoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $destacado = $request->input('destacado');
        $activo = $request->input('activo');
        $categorias = Categoria::all();
        $juegos = Juego::with('categoria', 'inventario')
            ->when($search, function ($query, $search) {
                return $query->where('titulo', 'like', '%' . $search . '%')
                             ->orWhere('descripcion', 'like', '%' . $search . '%')
                             ->orWhereHas('categoria', function ($categoriaQuery) use ($search) {
                                 $categoriaQuery->where('nombre_categoria', 'like', '%' . $search . '%');
                             });
            })
            ->when($destacado, function ($query) {
                return $query->where('destacado', true);
            })
            ->when($activo, function ($query) {
                return $query->where('activo', true);
            })
            ->paginate(10)
            ->appends($request->query()); // Keep other query parameters for pagination

        return view('admin.juego.index', compact('juegos','categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categorias = Categoria::all();
        return view('admin.juego.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'titulo' => 'required|string|max:50',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
            'requisitos_minimos' => 'nullable|string',
            'requisitos_recomendados' => 'nullable|string',
            'id_categoria' => 'required|exists:categorias,id',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|integer|min:0',
        ]);

        $imagen = $request->file('imagen');
        $nombreImagen = $imagen->getClientOriginalName();
        $moved = $imagen->move(public_path('images'), $nombreImagen);

        if (!$moved) {
            return redirect()->back()->withErrors(['imagen' => 'Error al mover el archivo.']);
        }

        $juego = Juego::create([
            'titulo' => $request->titulo,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
            'requisitos_minimos' => $request->requisitos_minimos,
            'requisitos_recomendados' => $request->requisitos_recomendados,
            'id_categoria' => $request->id_categoria,
            'imagen' => $nombreImagen,
            'destacado' => false,
        ]);

        Inventario::create([
            'id_juego' => $juego->id,
            'stock' => $request->stock,
        ]);

        return redirect()->route('admin.juegos.index')->with('success', 'Juego creado exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Juego $juego): View
    {
        $categorias = Categoria::all();
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
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|integer|min:0',
        ]);

        $dataToUpdate = $request->except(['_token', '_method', 'imagen']);

        if ($request->hasFile('imagen')) {
            if ($juego->imagen) {
                if (file_exists(public_path('images/' . $juego->imagen))) {
                    unlink(public_path('images/' . $juego->imagen));
                }
            }
            $imagen = $request->file('imagen');
            $nombreImagen = $imagen->getClientOriginalName();
            $imagen->move(public_path('images'), $nombreImagen);
            $dataToUpdate['imagen'] = $nombreImagen;
        }

        $juego->update($dataToUpdate);

        if ($juego->inventario) {
            $juego->inventario->update(['stock' => $request->stock]);
        } else {
            Inventario::create([
                'id_juego' => $juego->id,
                'stock' => $request->stock,
            ]);
        }

        return Redirect::route('admin.juegos.index')->with('success', 'Juego actualizado exitosamente');
    }

    public function destroy($id): RedirectResponse
    {
        DB::beginTransaction();
        
        try {
            $juego = Juego::findOrFail($id);
            $categoria = Categoria::findOrFail($juego->id_categoria);
            
            $nuevoEstado = !$juego->activo;
            
            if ($nuevoEstado) {
                $juego->activo = true;
                $juego->save();
                
                if (!$categoria->activo) {
                    $categoria->activo = true;
                    $categoria->save();
                    
                    DB::commit();
                    return redirect()->back()->with('success', 'Se ha activado el juego "' . $juego->titulo . '" y su categoría "' . $categoria->nombre_categoria . '".');
                }
                
                DB::commit();
                return redirect()->back()->with('success', 'Se ha activado el juego "' . $juego->titulo . '". La categoría "' . $categoria->nombre_categoria . '" ya estaba activa.');
            } else {
                $juego->activo = false;
                $juego->save();
                
                DB::commit();
                return redirect()->back()->with('success', 'Se ha desactivado el juego "' . $juego->titulo . '".');
            }
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al actualizar el estado del juego: ' . $e->getMessage());
        }
    }

    public function destacar(Juego $juego): RedirectResponse
    {
        $juego->destacado = !$juego->destacado;
        $juego->save();

        return redirect()->route('admin.juegos.index')->with('success', 'El juego "' . $juego->titulo . '" ha sido ' . ($juego->destacado ? 'destacado' : 'removido de destacados') . ' exitosamente.');
    }
}