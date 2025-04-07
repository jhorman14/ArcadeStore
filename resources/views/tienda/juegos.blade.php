@extends('layouts.app')

@section('content')
<link href="{{ asset('css/juegos.css') }}" rel="stylesheet" />
<link href="{{ asset('css/filtros.css') }}" rel="stylesheet" />
<div class="dashboard">
    <div class="sidebar">
        <div class="search-bar">
            <input type="text" id="search-term" placeholder="Buscar juegos..." value="{{ request('q') }}">
            <button onclick="buscar()">Buscar</button>
            <button onclick="limpiarBusqueda()" id="clear-search" style="display: none;">Limpiar</button>
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
        <section class="juegos">
            <h2>Juegos Adquiridos</h2>
            @if (count($juegosAdquiridos) > 0)
                <div class="juegos-galeria">
                    @foreach ($juegosAdquiridos as $juego)
                        <div class="juego-tarjeta">
                            <img src="{{ asset('images/' . $juego->imagen) }}" alt="{{ $juego->titulo }}">
                            <h3>{{ $juego->titulo }}</h3>
                            <p>{{ Str::limit($juego->descripcion, 100) }}</p>
                            <a href="{{-- Aquí iría la URL para jugar o descargar el juego --}}">
                                <button>Jugar/Descargar</button>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p>No has adquirido ningún juego aún.</p>
            @endif
        </section>

        {{-- Juegos disponibles para compra --}}
        <section class="juegos">
            <h2>Juegos Disponibles</h2>
            @if (count($juegos) > 0)
                <div class="juegos-galeria">
                    @foreach ($juegos as $juego)
                        <div class="juego-tarjeta">
                            <img src="{{ asset('images/' . $juego->imagen) }}" alt="{{ $juego->titulo }}">
                            <h3>{{ $juego->titulo }}</h3>
                            <p>{{ Str::limit($juego->descripcion, 100) }}</p>
                            <a href="{{ route('tienda.show', $juego->id) }}">
                                <button>Comprar</button>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
                        Mostrando {{ $juegos->firstItem() }} a {{ $juegos->lastItem() }} de {{ $juegos->total() }} registros
                    </div>
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            {{-- Botón de Anterior --}}
                            <li class="page-item {{ $juegos->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $juegos->previousPageUrl() }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
    
                            {{-- Números de Página --}}
                            @for ($i = 1; $i <= $juegos->lastPage(); $i++)
                                <li class="page-item {{ $juegos->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $juegos->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
    
                            {{-- Botón de Siguiente --}}
                            <li class="page-item {{ $juegos->currentPage() == $juegos->lastPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $juegos->nextPageUrl() }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            @else
                <p>No hay juegos disponibles en esta categoría.</p>
            @endif
        </section>
    </main>
</div>

<script>
    const searchTermInput = document.getElementById('search-term');
    const clearSearchButton = document.getElementById('clear-search');

    function buscar() {
        const searchTerm = searchTermInput.value;
        window.location.href = "{{ route('juegosDisp') }}?q=" + searchTerm;
    }

    function limpiarBusqueda() {
        searchTermInput.value = '';
        clearSearchButton.style.display = 'none';
        window.location.href = "{{ route('juegosDisp') }}";
    }

    function filtrarPorCategoria() {
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
            buscar();
        }
    });
</script>
@endsection
