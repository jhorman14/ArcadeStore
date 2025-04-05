@extends('layouts.app')

@section('template_title')
    Contáctenos
@endsection

<form ...>
    </form>
@section('content')
<link href="{{ asset('css/contacto.css') }}" rel="stylesheet" />

<div class="crear-juego-container">
    <h1>Contáctenos</h1>

    

    <form action="{{ route('enviar.mensaje') }}" method="POST">
        @csrf

        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>
        </div>

        <div>
            <label for="email">Correo electrónico:</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div>
            <label for="asunto">Asunto:</label>
            <input type="text" name="asunto" id="asunto" required>
        </div>

        <div>
            <label for="mensaje">Mensaje:</label>
            <textarea name="mensaje" id="mensaje" rows="5" required></textarea>
        </div>

        <button type="submit">Enviar mensaje</button>
    </form>


@endsection