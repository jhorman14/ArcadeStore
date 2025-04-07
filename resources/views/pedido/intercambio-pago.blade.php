@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ __('Pago Adicional para Intercambio') }}</h5>
                </div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="alert alert-info" role="alert">
                        <i class="fas fa-info-circle me-2"></i>
                        {{ __('Se requiere un pago adicional de:') }}
                        <strong>COP ${{ number_format($costoAdicional, 0, ',', '.') }}</strong>
                        {{ __('para completar el intercambio.') }}
                    </div>

                    <form method="POST" action="{{ route('intercambio.procesar-pago', $intercambio->id) }}" class="needs-validation" novalidate>
                        @csrf
                        <input type="hidden" name="intercambio_id" value="{{ $intercambio->id }}">
                        <input type="hidden" name="costo_adicional" value="{{ $costoAdicional }}">

                        <div class="mb-4">
                            <label for="metodo_de_pago" class="form-label fw-bold">
                                {{ __('Método de Pago') }}
                                <span class="text-danger">*</span>
                            </label>
                            <select 
                                name="metodo_de_pago" 
                                id="metodo_de_pago" 
                                class="form-select @error('metodo_de_pago') is-invalid @enderror" 
                                required
                            >
                                <option value="">{{ __('Seleccione un método de pago') }}</option>
                                <option value="tarjeta">{{ __('Tarjeta de Crédito/Débito') }}</option>
                                <option value="paypal">PayPal</option>
                                <option value="transferencia">{{ __('Transferencia Bancaria') }}</option>
                            </select>
                            @error('metodo_de_pago')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="alert alert-light border">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold">{{ __('Total a pagar:') }}</span>
                                <span class="h4 mb-0 text-primary">
                                    COP ${{ number_format($costoAdicional, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="{{ route('usuario.intercambios') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                {{ __('Cancelar') }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check me-2"></i>
                                {{ __('Confirmar Pago') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Validación del formulario del lado del cliente
(function () {
    'use strict'
    var forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false)
    })
})()
</script>
@endsection
