@extends('layouts.app')

@section('template_title')
    {{ __('Edit') }} Juego
@endsection

@section('content')
    <link href="{{ asset('css/stylef.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/form.css') }}" rel="stylesheet" />
    <div class="crear-juego-container">
        <h1>Editar Juego</h1>

        <form action="{{ route('admin.juegos.update', $juego->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div>
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" id="titulo" value="{{ $juego->titulo }}" required>
            </div>

            <div>
                <label for="precio">Precio:</label>
                <input type="number" name="precio" id="precio" step="0.01" value="{{ $juego->precio }}" required>
            </div>

            <div>
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion" rows="5" required>{{ $juego->descripcion }}</textarea>
            </div>

            <div>
                <label for="requisitos_minimos">Requisitos Mínimos:</label>
                <textarea name="requisitos_minimos" id="requisitos_minimos" rows="5">{{ $juego->requisitos_minimos }}</textarea>
            </div>

            <div>
                <label for="requisitos_recomendados">Requisitos Recomendados:</label>
                <textarea name="requisitos_recomendados" id="requisitos_recomendados" rows="5">{{ $juego->requisitos_recomendados }}</textarea>
            </div>

            <div>
                <label for="id_categoria">Categoría:</label>
                <select name="id_categoria" id="id_categoria" required>
                    <option value="">Seleccionar Categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ $juego->id_categoria == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre_categoria }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="imagen">Imagen:</label>
                <input type="file" name="imagen" id="imagen">
                @if ($juego->imagen)
                    <img src="{{ asset($juego->imagen) }}" alt="Imagen actual del juego" style="max-width: 200px; margin-top: 10px;">
                @endif
            </div>

            <button type="submit">Guardar Cambios</button>
        </form>
    </div>
@endsection