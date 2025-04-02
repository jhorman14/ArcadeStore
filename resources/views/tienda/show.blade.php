@extends('layouts.app')

@section('content')
<link href="{{ asset('css/detalleJuego.css') }}" rel="stylesheet" />

<div class="detalle-juego-moderno-container">
    <div class="detalle-juego-moderno-hero">
        <div class="hero-image-container">
            <img src="{{ asset('images/' . $juego->imagen) }}" alt="{{ $juego->titulo }}" class="hero-image">
        </div>
        <div class="hero-content">
            <h1>{{ $juego->titulo }}</h1>
            <p class="precio">COP ${{ number_format($juego->precio) }}</p>
            <div class="container">
                <div class="detalle-juego-actions">
                    <a href="{{ route('pedidos.create', ['juego_id' => $juego->id_juego]) }}" class="btn btn-success">Comprar ahora</a>
                </div>
            </div>
        </div>
    </div>

    <div class="detalle-juego-moderno-body">
        <div class="descripcion-seccion">
            <h2>Descripción</h2>
            <p>{{ $juego->descripcion }}</p>
        </div>

        <div class="informacion-adicional-seccion">
            <h2>Información Adicional</h2>
            <div class="informacion-columnas">
                <div>
                    <p><strong>Categoría:</strong> {{ $juego->categoria->nombre_categoria }}</p>
                    @if($juego->requisitos_minimos)
                    <p><strong>Requisitos Mínimos:</strong> {{ $juego->requisitos_minimos }}</p>
                    @endif
                </div>
                <div>
                    @if($juego->requisitos_recomendados)
                    <p><strong>Requisitos Recomendados:</strong> {{ $juego->requisitos_recomendados }}</p>
                    @endif
                    {{-- Puedes agregar más información aquí si es necesario --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection