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
                    @if ($comprado)
                    <a href="{{-- Aquí iría la URL de descarga o juego --}}" class="btn btn-primary">Descargar y jugar</a>
                    @else
                    <a href="{{ route('pedidos.create', ['juego_id' => $juego->id]) }}" class="btn btn-success">Comprar ahora</a>
                    @endif
                    @auth
                    <h3>Intercambiar por este juego</h3>
                    <form action="{{ route('intercambio.solicitar', ['juego_id' => $juego->id]) }}" method="POST">
                        @csrf
                        <div>
                            <label for="juego_ofrecido_id">Selecciona un juego de tu biblioteca para ofrecer:</label>
                            <select name="juego_ofrecido_id" id="juego_ofrecido_id" class="form-control">
                                <option value="">-- Selecciona un juego --</option>
                                @foreach (auth()->user()->juegosComprados as $juegoOfrecido)
                                @if ($juegoOfrecido->id !== $juego->id)
                                <option value="{{ $juegoOfrecido->id }}">{{ $juegoOfrecido->titulo }} (Precio: ${{ $juegoOfrecido->precio }})</option>
                                @endif
                                @endforeach
                            </select>
                            @error('juego_ofrecido_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Solicitar Intercambio</button>
                    </form>
                    @else
                    <p>Debes <a href="{{ route('login') }}">iniciar sesión</a> para realizar un intercambio.</p>
                    @endauth
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