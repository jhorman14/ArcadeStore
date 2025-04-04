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
                                {{ __('Create New') }}
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
                                    <th>Título</th>
                                    <th>Precio</th>
                                    <th>Descripción</th>
                                    <th>Requisitos Mínimos</th>
                                    <th>Requisitos Recomendados</th>
                                    <th>Id Categoría</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 0;
                                @endphp
                                @foreach ($juegos as $juego)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $juego->titulo }}</td>
                                    <td>{{ $juego->precio }}</td>
                                    <td>{{ $juego->descripcion }}</td>
                                    <td>{{ $juego->requisitos_minimos }}</td>
                                    <td>{{ $juego->requisitos_recomendados }}</td>
                                    <td>{{ $juego->id_categoria }}</td>
                                    <td>{{ $juego->activo ? 'Activo' : 'Inactivo' }}</td>
                                    <td>
                                        <form action="{{ route('juegos.destroy', $juego->id) }}" method="POST" class="d-inline">
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