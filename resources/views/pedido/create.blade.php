@extends('layouts.app')

@section('content')
<main class="form-buy">
    <div class="formulario-compra">
        <h1>Crear Nuevo Pedido</h1>

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

        <form action="{{ route('pedido.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="id_juego">Selecciona el Juego:</label>
                <select class="form-control @error('id_juego') is-invalid @enderror" id="id_juego" name="id_juego" required onchange="actualizarTotal()">
                    <option value="">Selecciona un juego</option>
                    @foreach ($juegos as $juego)
                    <option value="{{ $juego->id }}" data-precio="{{ $juego->precio }}" {{ old('id_juego') == $juego->id ? 'selected' : '' }}>
                        {{ $juego->titulo }} - ${{ number_format($juego->precio, 2) }}
                    </option>
                    @endforeach
                </select>
                @error('id_juego')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="metodo_de_pago">Método de Pago:</label>
                <select class="form-control @error('metodo_de_pago') is-invalid @enderror" id="metodo_de_pago" name="metodo_de_pago" required>
                    <option value="">Selecciona un método de pago</option>
                    <option value="Tarjeta de Crédito" {{ old('metodo_de_pago') == 'Tarjeta de Crédito' ? 'selected' : '' }}>Tarjeta de Crédito</option>
                    <option value="PayPal" {{ old('metodo_de_pago') == 'PayPal' ? 'selected' : '' }}>PayPal</option>
                    <option value="Transferencia Bancaria" {{ old('metodo_de_pago') == 'Transferencia Bancaria' ? 'selected' : '' }}>Transferencia Bancaria</option>
                </select>
                @error('metodo_de_pago')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="total">Total del Pedido:</label>
                <input type="text" class="form-control" id="total" name="total" value="{{ old('total', '0.00') }}" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Realizar Pedido</button>
        </form>
    </div>

    <script>
        function actualizarTotal() {
            const juegoSelect = document.getElementById('id_juego');
            const precio = parseFloat(juegoSelect.options[juegoSelect.selectedIndex].getAttribute('data-precio')) || 0;
            document.getElementById('total').value = precio.toFixed(2);
        }

        // Actualizar el total al cargar la página si ya hay un juego seleccionado
        window.onload = actualizarTotal;
    </script>
</main class="form-buy">
@endsection
