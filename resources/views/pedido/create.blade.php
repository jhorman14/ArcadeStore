@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Nuevo Pedido</h1>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('pedidos.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="id_juego">Selecciona el Juego:</label>
                <select class="form-control @error('id_juego') is-invalid @enderror" id="id_juego" name="id_juego" required onchange="actualizarTotal()">
                    <option value="">Selecciona un juego</option>
                    @foreach ($juegos as $juego)
                        <option value="{{ $juego->id_juego }}" {{ $juego_id == $juego->id_juego ? 'selected' : '' }} data-precio="{{ $juego->Precio }}">
                            {{ $juego->titulo }} - ${{ number_format($juego->Precio, 2) }}
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
                    <option value="Tarjeta de Crédito">Tarjeta de Crédito</option>
                    <option value="PayPal">PayPal</option>
                    <option value="Transferencia Bancaria">Transferencia Bancaria</option>
                </select>
                @error('metodo_de_pago')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="total">Total del Pedido:</label>
                <input type="text" class="form-control" id="total" name="total" value="0.00" readonly>
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
@endsection