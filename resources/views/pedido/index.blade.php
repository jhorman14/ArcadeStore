@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            {{ __('Ventas') }}
                        </span>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="dashboard"> {{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success m-4">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card-body bg-white">
                    <div class="table-responsive">
                        {{-- Tabla con las clases del código de referencia --}}
                        <table class="table table-striped table-hover">
                            {{-- Cabecera de la tabla con la clase thead --}}
                            <thead class="thead">
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                    <th>Juego</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pedidos as $pedido)
                                    <tr>
                                        <td>{{ $pedido->id }}</td>
                                        <td>{{ $pedido->fecha_pedido }}</td>
                                        <td>{{ $pedido->estado_pedido }}</td>
                                        <td>{{ $pedido->juego->titulo }}</td>
                                        <td>
                                            {{-- El botón ya usaba clases similares (btn btn-sm), mantenemos btn-info --}}
                                            <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-sm btn-info">Ver Detalles</a>
                                            {{-- Si necesitaras más botones como en el ejemplo, los añadirías aquí --}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        {{-- Asegúrate que colspan coincide con el número de columnas --}}
                                        <td colspan="5">No has realizado ningún pedido aún.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
                    Mostrando {{ $pedidos->firstItem() }} a {{ $pedidos->lastItem() }} de {{ $pedidos->total() }} registros
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        {{-- Botón de Anterior --}}
                        <li class="page-item {{ $pedidos->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $pedidos->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        {{-- Números de Página --}}
                        @for ($i = 1; $i <= $pedidos->lastPage(); $i++)
                            <li class="page-item {{ $pedidos->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $pedidos->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        {{-- Botón de Siguiente --}}
                        <li class="page-item {{ $pedidos->currentPage() == $pedidos->lastPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $pedidos->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            
        {{-- End Pagination Section --}}

            <h2>Juegos de tu Propiedad</h2>
            @if ($juegosComprados->count() > 0)
                <div class="row">
                    @foreach ($juegosComprados as $juego)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $juego->titulo }}</h5>
                                    <p class="card-text">Precio: ${{ number_format($juego->precio, 2) }}</p>
                                    <p class="card-text">¡Ya tienes este juego!</p>
                                    <a href="{{ route('tienda.show', $juego->id) }}" class="btn btn-secondary">Ver Detalles del Juego</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>Aún no tienes juegos en tu propiedad.</p>
            @endif
        </div>
    </div>
</div>
@endsection