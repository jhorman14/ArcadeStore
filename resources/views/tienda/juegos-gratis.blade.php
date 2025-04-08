@extends('layouts.app')

@section('content')
<link href="{{ asset('css/juegos.css') }}" rel="stylesheet" />
<link href="{{ asset('css/filtros.css') }}" rel="stylesheet" />
<div class="dashboard">
    <div class="sidebar">
        <div class="search-bar">
            <input type="text" id="search-term" placeholder="Buscar juegos..." value="{{ request('q') }}">
            <button onclick="buscarGratis()">Buscar</button>
            <button onclick="limpiarBusquedaGratis()" id="clear-search" style="display: none;">Limpiar</button>
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
                        </div>
                    @endforeach
                </div>
            @else
                <p>No hay juegos gratis disponibles en esta categoría.</p>
            @endif
        </section>
    </main>
</div>
<div class="d-flex justify-content-between align-items-center">
    <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
        Mostrando {{ $juegosGratis->firstItem() }} a {{ $juegosGratis->lastItem() }} de {{ $juegosGratis->total() }} registros
    </div>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            {{-- Botón de Anterior --}}
            <li class="page-item {{ $juegosGratis->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $juegosGratis->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            {{-- Números de Página --}}
            @for ($i = 1; $i <= $juegosGratis->lastPage(); $i++)
                <li class="page-item {{ $juegosGratis->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $juegosGratis->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            {{-- Botón de Siguiente --}}
            <li class="page-item {{ $juegosGratis->currentPage() == $juegosGratis->lastPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $juegosGratis->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

<script>
    const searchTermInput = document.getElementById('search-term');
    const clearSearchButton = document.getElementById('clear-search');

    function buscarGratis() {
        const searchTerm = searchTermInput.value;
        window.location.href = "{{ route('tienda.juegos-gratis') }}?q=" + searchTerm;
    }

    function limpiarBusquedaGratis() {
        searchTermInput.value = '';
        clearSearchButton.style.display = 'none';
        window.location.href = "{{ route('tienda.juegos-gratis') }}";
    }

    function filtrarGratisPorCategoria() {
        const categoriaId = document.getElementById('filter-categoria').value;
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('categoria', categoriaId);
        window.location.href = currentUrl.toString();
    }

    searchTermInput.addEventListener('input', function() {
        clearSearchButton.style.display = this.value ? 'inline-block' : 'none';
    });

    searchTermInput.addEventListener('keyup', function(event) {
        if (event.key === 'Enter') {
            buscarGratis();
        }
    });
</script>
@endsection
