@extends('layouts.app')
@section('content')

<link href="{{ asset('css/juegos.css') }}" rel="stylesheet" />

<main>
    <br><br><br>

    {{-- Juegos adquiridos --}}
    @if (count($juegosAdquiridos) > 0)
        <section class="juegos">
            <h2>Juegos Adquiridos</h2>
            <div class="juegos-galeria">
                @foreach ($juegosAdquiridos as $juego)
                    <div class="juego-tarjeta">
                        <img src="{{ asset('images/' . $juego->imagen) }}" alt="{{ $juego->titulo }}">
                        <h3>{{ $juego->titulo }}</h3>
                        <p>{{ $juego->descripcion }}</p>
                        <a href="{{-- Aquí iría la URL para jugar o descargar el juego --}}">
                            <button>Jugar/Descargar</button>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- Juegos disponibles para compra --}}
    <section class="juegos">
        <h2>Juegos Disponibles</h2>
        <div class="juegos-galeria">
            @foreach ($juegos as $juego)
                <div class="juego-tarjeta">
                    <img src="{{ asset('images/' . $juego->imagen) }}" alt="{{ $juego->titulo }}">
                    <h3>{{ $juego->titulo }}</h3>
                    <p>{{ $juego->descripcion }}</p>
                    <a href="{{ route('tienda.show', $juego->id) }}">
                        <button>Comprar</button>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
</main>
@endsection

<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>