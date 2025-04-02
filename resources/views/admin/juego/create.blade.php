@extends('layouts.app')

@section('template_title')
    {{ __('create') }} Juego
@endsection

@section('content')
    <link href="{{ asset('css/stylef.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/form.css') }}" rel="stylesheet" />
    <div class="crear-juego-container">
        <h1>Editar Juego</h1>

        <form action="{{ route('admin.juegos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div>
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" required>
    </div>

    <div>
        <label for="precio">Precio:</label>
        <input type="number" name="precio" id="precio" step="0.01" required>
    </div>

    <div>
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" rows="5" required></textarea>
    </div>

    <div>
        <label for="requisitos_minimos">Requisitos Mínimos:</label>
        <textarea name="requisitos_minimos" id="requisitos_minimos" rows="5"></textarea>
    </div>

    <div>
        <label for="requisitos_recomendados">Requisitos Recomendados:</label>
        <textarea name="requisitos_recomendados" id="requisitos_recomendados" rows="5"></textarea>
    </div>

    <div>
        <label for="id_categoria">Categoría:</label>
        <select name="id_categoria" id="id_categoria" required>
            <option value="">Seleccionar Categoría</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoria }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="imagen">Imagen:</label>
        <input type="file" name="imagen" id="imagen">
    </div>

    <button type="submit">Crear Juego</button>
</form>
    </div>
@endsection