@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Pago Adicional para Intercambio') }}</div>

                <div class="card-body">
                    <div class="alert alert-info" role="alert">
                        {{ __('Se requiere un pago adicional de:') }}
                        <strong>COP ${{ number_format($costoAdicional) }}</strong>
                        {{ __('para completar el intercambio.') }}
                    </div>

                    <form action="{{ route('intercambio.procesar-pago', $intercambio->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="metodo_de_pago" class="form-label">{{ __('Método de Pago') }}</label>
                            <select class="form-select" id="metodo_de_pago" name="metodo_de_pago" required>
                                <option value="">{{ __('Selecciona un método de pago') }}</option>
                                <option value="tarjeta_credito">{{ __('Tarjeta de Crédito') }}</option>
                                <option value="paypal">{{ __('PayPal') }}</option>
                                <option value="transferencia_bancaria">{{ __('Transferencia Bancaria') }}</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">
                            {{ __('Confirmar Pago') }}
                        </button>

                        <a href="{{ route('usuario.intercambios') }}" class="btn btn-secondary ms-2">
                            {{ __('Cancelar') }}
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
