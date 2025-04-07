@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            {{ __('Registro de Intercambios') }}
                        </span>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.dashboard') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success m-4">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card-body bg-white">
                    {{-- Search and Filter Bar --}}
                    <div class="mb-3">
                        <form action="{{ route('intercambios') }}" method="GET">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="search" placeholder="Buscar por usuario o juego..." value="{{ request('search') }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" name="start_date" value="{{ request('start_date') }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" name="end_date" value="{{ request('end_date') }}">
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">Filtrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>Juego Solicitado</th>
                                    <th>Juego Ofrecido</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($intercambios as $intercambio)
                                    <tr>
                                        <td>{{ $intercambio->id }}</td>
                                        <td>{{ $intercambio->usuario->name }}</td>
                                        <td>{{ $intercambio->juegoSolicitado->titulo ?? 'N/A' }}</td>
                                        <td>{{ $intercambio->juegoOfrecido->titulo ?? 'N/A' }}</td>
                                        <td>{{ $intercambio->fecha_intercambio }}</td>
                                        <td>{{ $intercambio->estado_intercambio }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No hay intercambios registrados.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
                    Mostrando {{ $intercambios->firstItem() }} a {{ $intercambios->lastItem() }} de {{ $intercambios->total() }} registros
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        {{-- Botón de Anterior --}}
                        <li class="page-item {{ $intercambios->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $intercambios->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        {{-- Números de Página --}}
                        @for ($i = 1; $i <= $intercambios->lastPage(); $i++)
                            <li class="page-item {{ $intercambios->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $intercambios->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        {{-- Botón de Siguiente --}}
                        <li class="page-item {{ $intercambios->currentPage() == $intercambios->lastPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $intercambios->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
