@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalles del Pedido</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Pedido #{{ $pedido->id }}</h5>
                <p class="card-text">Fecha del Pedido: {{ $pedido->fecha_pedido }}</p>
                <p class="card-text">Estado del Pedido: {{ $pedido->estado_pedido }}</p>
                <p class="card-text">Juego: {{ $pedido->juego->titulo }}</p>
                @if ($pedido->pago)
                    <p class="card-text">Método de Pago: {{ $pedido->pago->metodo_de_pago }}</p>
                    <p class="card-text">Total del Pedido: ${{ number_format($pedido->pago->total, 2) }}</p>
                @else
                    <p class="card-text">Información de Pago no disponible.</p>
                @endif
                <a href="{{ route('pedidos.index') }}" class="btn btn-primary">Volver a Mis Pedidos</a>
            </div>
        </div>
    </div>
@endsection