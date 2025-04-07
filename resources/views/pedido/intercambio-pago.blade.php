@extends('layouts.app')

@section('content')
<div class="container-pedido">
    <link href="{{ asset('css/pedido.css') }}" rel="stylesheet" />
    <h1 class="header-title">Pago Adicional para Intercambio</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form id="intercambio-pago-form" action="{{ route('intercambio.procesar-pago', $intercambio->id) }}" method="POST">
        @csrf
        <input type="hidden" name="intercambio_id" value="{{ $intercambio->id }}">
        <input type="hidden" name="costo_adicional" value="{{ $costoAdicional }}">

        <div class="form-group">
            <label for="metodo_de_pago">Método de Pago:</label>
            <select class="form-control @error('metodo_de_pago') is-invalid @enderror" id="metodo_de_pago" name="metodo_de_pago" required>
                <option value="">Selecciona un método de pago</option>
                <option value="tarjeta" {{ old('metodo_de_pago') == 'tarjeta' ? 'selected' : '' }}>Tarjeta de Crédito/Débito</option>
                <option value="paypal" {{ old('metodo_de_pago') == 'paypal' ? 'selected' : '' }}>PayPal</option>
                <option value="transferencia" {{ old('metodo_de_pago') == 'transferencia' ? 'selected' : '' }}>Transferencia Bancaria</option>
            </select>
            @error('metodo_de_pago')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="total">Total a Pagar:</label>
            <input type="text" class="form-control" id="total" name="total" value="{{ number_format($costoAdicional, 0, ',', '.') }}" readonly>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('usuario.intercambios') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>
                {{ __('Cancelar') }}
            </a>
            <button type="submit" class="btn btn-primary">Confirmar Pago</button>
        </div>
    </form>
</div>
@endsection
