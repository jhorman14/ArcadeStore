@extends('layouts.app')

@section('template_title')
    Contáctenos
@endsection

@section('content')
<link href="{{ asset('css/contacto.css') }}" rel="stylesheet" />

<div class="crear-juego-container">
    <h1>Contáctenos</h1>

    <div class="contact-info">
            <p><strong>Correo electrónico:</strong> <a href="mailto:arcadestore@gmail.com">arcadestore@gmail.com</a></p>
            <p><strong>Teléfono:</strong> +57 1234567890</p>
            <p><strong>Pais:</strong> Colombia</p>
        </div>

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

    <div class="social-links">
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
    </div>
</div>
@endsection