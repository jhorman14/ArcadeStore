@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            {{ __('Mis Intercambios') }}
                        </span>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('profile.show', Auth::id()) }}"> {{ __('Back') }}</a>
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
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Juego Solicitado') }}</th>
                                    <th>{{ __('Juego Ofrecido') }}</th>
                                    <th>{{ __('Fecha') }}</th>
                                    <th>{{ __('Estado') }}</th>
                                    <th>{{ __('Acciones') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($intercambios as $intercambio)
                                    <tr>
                                        <td>{{ $intercambio->id }}</td>
                                        <td>{{ $intercambio->juegoSolicitado->titulo ?? 'N/A' }}</td>
                                        <td>{{ $intercambio->juegoOfrecido->titulo ?? 'N/A' }}</td>
                                        <td>{{ $intercambio->fecha_intercambio }}</td>
                                        <td>{{ $intercambio->estado_intercambio }}</td>
                                        <td>
                                            @if($intercambio->estado_intercambio === 'Pendiente_Pago')
                                                <a href="{{ route('intercambio.pendiente-pago', $intercambio->id) }}" 
                                                   class="btn btn-primary btn-sm">
                                                    <i class="fas fa-money-bill me-1"></i>
                                                    {{ __('Realizar Pago') }}
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No tienes ningún intercambio registrado.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
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
@endsection