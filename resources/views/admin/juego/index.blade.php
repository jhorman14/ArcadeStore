@extends('layouts.app')

@section('template_title')
Juegos
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            {{ __('Juegos') }}
                        </span>
                        <div style="display: flex; align-items: center;"> {{-- Container for the buttons --}}
                            <div class="float-right">
                                <a href="#" data-toggle="modal" data-target="#ModalCreate" class="btn btn-primary btn-sm"> {{ __('Crear Nuevo Juego') }}</a>
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.dashboard') }}"> {{ __('Back') }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success m-4">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body bg-white">
                    {{-- Search Bar --}}
                    <div class="mb-3">
                        <form action="{{ route('admin.juegos.index') }}" method="GET">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="search" placeholder="Buscar por título..." value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="destacado" name="destacado" value="1" {{ request('destacado') ? 'checked' : '' }}>
                                <label class="form-check-label" for="destacado">Mostrar Destacados</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="activo" name="activo" value="1" {{ request('activo') ? 'checked' : '' }}>
                                <label class="form-check-label" for="activo">Mostrar Activos</label>
                            </div>

                            <button type="submit" class="btn btn-secondary btn-sm ml-2">Filtrar</button>
                            <a href="{{ route('admin.juegos.index') }}" class="btn btn-light btn-sm ml-2">Limpiar Filtros</a>
                        </form>
                    </div>

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Imagen y Título</th>
                                        <th>Precio</th>
                                        <th>Descripción</th>
                                        <th>Requisitos Mínimos</th>
                                        <th>Requisitos Recomendados</th>
                                        <th>Categoría</th>
                                        <th>Estado</th>
                                        <th>Stock</th> {{-- Nueva columna para el stock --}}
                                        <th>Acciones</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach ($juegos as $juego)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                                                <img src="{{ asset('images/' . $juego->imagen) }}" alt="{{ $juego->titulo }}" style="max-width: 100px; max-height: 100px; margin-bottom: 5px;">
                                                <span>{{ $juego->titulo }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $juego->precio }}</td>
                                        <td>{{ Str::limit($juego->descripcion, 50) }}</td>
                                        <td>{{ Str::limit($juego->requisitos_minimos, 30) }}</td>
                                        <td>{{ Str::limit($juego->requisitos_recomendados, 30) }}</td>
                                        <td>{{ $juego->categoria->nombre_categoria }}</td>
                                        <td>{{ $juego->activo ? 'Activo' : 'Inactivo' }}</td>
                                        <td>{{ $juego->inventario ? $juego->inventario->stock : 'N/A' }}</td>
                                        <td>
                                            <form action="{{ route('admin.juegos.destacar', $juego->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-{{ $juego->destacado ? 'warning' : 'info' }}" title="{{ $juego->destacado ? 'Quitar de destacados' : 'Marcar como destacado' }}">
                                                    <i class="fa fa-star{{ $juego->destacado ? '' : '-o' }}"></i> {{ $juego->destacado ? 'Quitar Destacado' : 'Destacar' }}
                                                </button>
                                            </form>
                                            <a class="btn btn-sm btn-success" href="{{ route('juegos.edit', $juego->id) }}" title="Editar"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                            <form action="{{ route('juegos.destroy', $juego->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                @php
                                                $confirmMessage = '¿Estás seguro de que quieres ' . ($juego->activo ? 'desactivar' : 'activar') . ' este juego?';
                                                @endphp
                                                <button type="submit" class="btn btn-sm btn-danger" title="{{ $juego->activo ? 'Desactivar' : 'Activar' }}" onclick="return confirm('{{ $confirmMessage }}')">
                                                    <i class="fa fa-power-off"></i> {{ $juego->activo ? 'Desactivar' : 'Activar' }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Pagination Section --}}
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

            {{-- End Pagination Section --}}
        </div>
    </div>
</div>
@endsection
@include('admin.juego.modal.create')