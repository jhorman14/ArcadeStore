@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/pedido.css') }}" rel="stylesheet" />
    <div class="container-ped">
        <h1 class="header-title">Detalles del Pedido</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card-ped">
            <div class="card-body-ped">
                <h5 class="card-title-ped">Pedido #{{ $pedido->id }}</h5>
                <p class="card-text-ped">Fecha del Pedido: {{ $pedido->fecha_pedido }}</p>
                <p class="card-text-ped">Estado del Pedido: {{ $pedido->estado_pedido }}</p>
                <p class="card-text-ped">Juego: {{ $pedido->juego->titulo }}</p>
                @if ($pedido->pago)
                    <p class="card-text-ped">Método de Pago: {{ $pedido->pago->metodo_de_pago }}</p>
                    <p class="card-text-ped">Total del Pedido: ${{ number_format($pedido->pago->total, 2) }}</p>
                @else
                    <p class="card-text-ped">Información de Pago no disponible.</p>
                @endif
                <a href="{{ route('pedidos.index') }}" class="btn btn-primary">Volver a Mis Pedidos</a>
            </div>
        </div>
    </div>
@endsection