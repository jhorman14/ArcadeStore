@extends('layouts.app')

@section('content')
<link href="{{ asset('css/pedido.css') }}" rel="stylesheet" />
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-ped">
                    <div class="card-header">Gracias por tu compra</div>

                    <div class="card-body-ped">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <p>Tu pedido ha sido procesado exitosamente.</p>
                        <p>El total de tu compra fue: ${{ number_format($pedido->pago->total, 2) }}</p>
                        <p>Puedes ver los detalles de tu pedido <a href="{{ route('pedidos.show', $pedido->id) }}">aquí</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection