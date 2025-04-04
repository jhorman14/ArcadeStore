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
                            <div class="float-right">
                                <a href="{{ route('juegos.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                    {{ __('Crear Nuevo') }}
                                </a>
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
                                            <td>{{ $loop->iteration }}</td> {{-- Usando $loop->iteration en lugar de $i --}}
                                            <td>
                                                <div style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                                                    <img src="{{ asset('images/' . $juego->imagen) }}" alt="{{ $juego->titulo }}" style="max-width: 100px; max-height: 100px; margin-bottom: 5px;">
                                                    <span>{{ $juego->titulo }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $juego->precio }}</td>
                                            <td>{{ $juego->descripcion }}</td>
                                            <td>{{ $juego->requisitos_minimos }}</td>
                                            <td>{{ $juego->requisitos_recomendados }}</td>
                                            <td>{{ $juego->categoria->nombre_categoria }}</td>
                                            <td>{{ $juego->activo ? 'Activo' : 'Inactivo' }}</td>
                                            <td>{{ $juego->inventario ? $juego->inventario->stock : 'N/A' }}</td> {{-- Mostrar stock o N/A si no existe --}}
                                            <td>
                                                <form action="{{ route('juegos.destroy', $juego->id) }}" method="POST" class="d-inline">
                                                    <a class="btn btn-sm btn-success" href="{{ route('juegos.edit', $juego->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    @php
                                                        $confirmMessage = '¿Estás seguro de que quieres ' . ($juego->activo ? 'desactivar' : 'activar') . ' este juego?';
                                                    @endphp
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ $confirmMessage }}')">
                                                        {{ $juego->activo ? 'Desactivar' : 'Activar' }}
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
                {!! $juegos->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection