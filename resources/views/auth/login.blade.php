<link href="{{ asset('css/login.css') }}" rel="stylesheet" />
<link href="{{ asset('css/style.css') }}" rel="stylesheet" />
<link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'ArcadeStore') }}</title> <link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

<link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

<div class="login-container">
    <img src="images/logo.png" alt="Logo" class="logo">
    <h2>Iniciar sesión</h2>
    <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label for="email">{{ __('Direccion de correo electrónico') }}</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    
                </span>
            @enderror

            <label for="password">{{ __('Contraseña') }}</label>
            <div class="password-container">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">
                <span class="toggle-password" id="togglePassword">👁️</span>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <a href="{{ route('password.request') }}"
                class="forgot-password">{{ __('¿Has olvidado la contraseña?') }}</a>

            <button type="submit" class="login-button">
                {{ __('Iniciar sesión') }}
            </button>

            <p class="or">o iniciar sesión con</p>
            <div class="social-login">
                <button class="social-btn xbox"><i class="fab fa-xbox"></i></button>
                <button class="social-btn steam"><i class="fab fa-steam"></i></button>
                <button class="social-btn facebook"><i class="fab fa-facebook-f"></i></button>
                <button class="social-btn google"><i class="fab fa-google"></i></button>
                <button class="social-btn apple"><i class="fab fa-apple"></i></button>
            </div>
        </form>
        <a href="{{ route('register') }}" class="create-account">Crear una cuenta</a>
        <a href="#" class="privacy-policy">Política de privacidad</a>
    </div>
</div>

<script>
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.textContent = type === 'password' ? '◠' : '☉'; // Cambiar el icono
    });
</script>