@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            {{ __('Categorias') }}
                        </span>
                        <div class="float-right">
                            <a href="{{ route('categorias.create') }}" class="btn btn-primary btn-sm"> {{ __('Crear Nueva Categoria') }}</a>
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
                    {{-- Search Bar --}}
                    <div class="mb-3">
                        <form action="{{ route('categorias.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Buscar por nombre..." value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Activo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categorias as $categoria)
                                    <tr>
                                        <td>{{ $categoria->id }}</td>
                                        <td>{{ $categoria->nombre_categoria }}</td>
                                        <td >{{ $categoria->descripcion }}</td>
                                        <td>
                                            <span class="badge {{ $categoria->activo ? 'bg-success' : 'bg-danger' }}">
                                                {{ $categoria->activo ? 'Activo' : 'Inactivo' }}
                                            </span>
                                        </td>
                                        <td>
                                                <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" class="d-inline">
                                                    <a class="btn btn-sm btn-success" href="{{ route('categorias.edit', $categoria->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    @php
                                                        $confirmMessage = '¿Estás seguro de que quieres ' . ($categoria->activo ? 'desactivar' : 'activar') . ' este juego?';
                                                    @endphp
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ $confirmMessage }}')">
                                                        {{ $categoria->activo ? 'Desactivar' : 'Activar' }}
                                                    </button>
                                                </form>
                                            </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">No hay categorías registradas.</td>
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
            Mostrando {{ $categorias->firstItem() }} a {{ $categorias->lastItem() }} de {{ $categorias->total() }} registros
        </div>
        <nav aria-label="Page navigation">
            <ul class="pagination">
                {{-- Botón de Anterior --}}
                <li class="page-item {{ $categorias->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $categorias->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
    
                {{-- Números de Página --}}
                @for ($i = 1; $i <= $categorias->lastPage(); $i++)
                    <li class="page-item {{ $categorias->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $categorias->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
    
                {{-- Botón de Siguiente --}}
                <li class="page-item {{ $categorias->currentPage() == $categorias->lastPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $categorias->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
@endsection
