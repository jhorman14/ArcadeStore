@extends('layouts.app')
@section('content')

<link href="{{ asset('css/juegos.css') }}" rel="stylesheet" />
<link href="{{ asset('css/filtros.css') }}" rel="stylesheet" />
<div class="dashboard">
    <!--barra lateral-->
    <div class="sidebar">
        <div class="search-bar">
            <input type="text" id="search-term" placeholder="Buscar...">
            <button onclick="buscar()">Buscar</button>
        </div>

        <div class="filter-group">
            <label for="filter-categoria">Filtrar por Categoría:</label>
            <select id="filter-categoria" name="filter-categoria" onchange="filtrarPorCategoria()">
                <option value="">Todas las Categorías</option>
                @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nombre_categoria }}
                </option>
                @endforeach
            </select>
        </div>
    </div>

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