@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/pedido.css') }}" rel="stylesheet" />

<h1>Pago Adicional para Intercambio</h1>

<p>Estás solicitando el juego: {{ $intercambio->productoSolicitado->titulo }}</p>
<p>Ofreciste el juego: {{ $intercambio->productoOfrecido->titulo }}</p>

@if (session('costo_adicional') > 0)
    <p>El costo adicional a pagar es: ${{ number_format(session('costo_adicional'), 2) }}</p>

    <form action="{{ route('intercambio.procesar-pago', $intercambio) }}" method="POST">
        @csrf
        <input type="hidden" name="intercambio_id" value="{{ $intercambio->id }}">
        <input type="hidden" name="monto" value="{{ session('costo_adicional') }}">
        <button type="submit" class="btn btn-success">Pagar y Finalizar Intercambio</button>
    </form>
@else
    <p>El intercambio no requiere pago adicional.</p>
    <a href="{{ route('usuario.intercambios') }}" class="btn btn-info">Volver a mis intercambios</a>
@endif

@endsection