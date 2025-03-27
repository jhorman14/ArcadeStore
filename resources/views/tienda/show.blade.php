@extends('layouts.app')

@section('content')
<!-- end slider section -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $juego->titulo }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ asset('images/' . $juego->imagen) }}" alt="{{ $juego->titulo }}" class="img-fluid">
                        </div>
                        <div class="col-md-6">
                            <h2>Precio: ${{ number_format($juego->precio, 2) }}</h2>
                            <p>{{ $juego->descripcion }}</p>

                            <div class="mt-3">
                                <button class="btn btn-primary">Comprar ahora</button>
                                <a href="{{ route('biblioteca') }}" class="btn btn-secondary">Volver a la biblioteca</a>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h4>Información Adicional</h4>
                    <div class="row">
                        <div class="col-md-6">
                            @if($juego->descripcion)
                            <p><strong>Descripcion:</strong> {{ $juego->descripcion }}</p>
                            @endif
                            <p><strong>Categoría:</strong> {{ $juego->categoria->nombre_categoria }}</p>
                            @if($juego->requisitos_minimos)
                            <p><strong>Requisitos Mínimos:</strong> {{ $juego->requisitos_minimos }}</p>
                            @endif
                            @if($juego->requisitos_recomendados)
                            <p><strong>Requisitos Recomendados:</strong> {{ $juego->requisitos_recomendados }}</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            {{-- Puedes agregar más información aquí si es necesario --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection