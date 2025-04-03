@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Mis Pedidos</h1>

        <table class="table">
            <thead>
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
                            <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-sm btn-info">Ver Detalles</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No has realizado ningún pedido aún.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $pedidos->links() }}

        <hr>

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
@endsection