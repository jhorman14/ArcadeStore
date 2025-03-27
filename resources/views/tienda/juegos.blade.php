@extends('layouts.app')
@section('content')

<link href="{{ asset('css/juegos.css') }}" rel="stylesheet" />

    <section class=" slider_section position-relative">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner">
                </div>
        </div>
    </section>
    <main>
        <br><br><br>
        <section class="juegos">
            <h2>Juegos Disponibles</h2>
            <div class="juegos-galeria">
                @foreach ($juegos as $juego)
                    <div class="juego-tarjeta">
                        <img src="{{ asset('images/' . $juego->imagen) }}" alt="{{ $juego->titulo }}">
                        <h3>{{ $juego->titulo }}</h3>
                        <p>{{ $juego->descripcion }}</p>
                        <button>Comprar</button>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
    @endsection

<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>