@extends('layouts.app')

@section('content')
<link href="{{ asset('css/juegos.css') }}" rel="stylesheet" />
<link href="{{ asset('css/filtros.css') }}" rel="stylesheet" />
<div class="dashboard">
    <div class="sidebar">
        <div class="search-bar">
            <input type="text" id="search-term" placeholder="Buscar...">
            <button onclick="buscarGratis()">Buscar</button>
        </div>

        <div class="filter-group">
            <label for="filter-categoria">Filtrar por Categoría:</label>
            <select id="filter-categoria" name="filter-categoria" onchange="filtrarGratisPorCategoria()">
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

        <section class="juegos">
            <h2>Juegos Gratis</h2>
            @if (count($juegosGratis) > 0)
                <div class="juegos-galeria">
                    @foreach ($juegosGratis as $juego)
                        <div class="juego-tarjeta">
                            <img src="{{ asset('images/' . $juego->imagen) }}" alt="{{ $juego->titulo }}">
                            <h3>{{ $juego->titulo }}</h3>
                            <p>{{ Str::limit($juego->descripcion, 100) }}</p>
                            <a href="{{ route('tienda.show', $juego->id) }}">
                                <button>Ver Detalles</button>
                            </a>
                            {{-- Aquí podrías agregar un botón para reclamar el juego si es necesario --}}
                        </div>
                    @endforeach
                </div>
                {{ $juegosGratis->links() }}
            @else
                <p>No hay juegos gratis disponibles en esta categoría.</p>
            @endif
        </section>
    </main>
</div>

<script>
    function buscarGratis() {
        const searchTerm = document.getElementById('search-term').value;
        window.location.href = "{{ route('tienda.juegos-gratis') }}?q=" + searchTerm;
    }

    function filtrarGratisPorCategoria() {
        const categoriaId = document.getElementById('filter-categoria').value;
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('categoria', categoriaId);
        window.location.href = currentUrl.toString();
    }
</script>
@endsection