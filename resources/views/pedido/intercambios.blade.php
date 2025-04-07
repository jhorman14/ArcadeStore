@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('Mis Intercambios') }}</h1>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if ($intercambios->isEmpty())
        <p>{{ __('No tienes ningún intercambio registrado.') }}</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Juego Solicitado') }}</th>
                    <th>{{ __('Juego Ofrecido') }}</th>
                    <th>{{ __('Fecha') }}</th>
                    <th>{{ __('Estado') }}</th>
                    <th>{{ __('Acciones') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($intercambios as $intercambio)
                    <tr>
                        <td>{{ $intercambio->id }}</td>
                        <td>{{ $intercambio->juegoSolicitado->titulo ?? 'N/A' }}</td>
                        <td>{{ $intercambio->juegoOfrecido->titulo ?? 'N/A' }}</td>
                        <td>{{ $intercambio->fecha_intercambio }}</td>
                        <td>{{ $intercambio->estado_intercambio }}</td>
                        <td>
                            @if($intercambio->estado_intercambio === 'Pendiente_Pago')
                                <a href="{{ route('intercambio.pendiente-pago', $intercambio->id) }}" 
                                   class="btn btn-primary btn-sm">
                                    <i class="fas fa-money-bill me-1"></i>
                                    {{ __('Realizar Pago') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $intercambios->links() }}
    @endif
</div>
@endsection
