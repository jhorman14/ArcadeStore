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
    <h2>{{ __('Registro') }}</h2>
    <div class="card-body">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <label for="name">{{ __('Nombre completo') }}</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <label for="email">{{ __('Correo') }}</label>
            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <label for="nick">{{ __('Nick-name') }}</label>
            <input id="nick" type="text" class="form-control @error('nick') is-invalid @enderror" name="nick"
                value="{{ old('nick') }}" required autocomplete="nick" autofocus>

            @error('nick')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <label for="telefono">{{ __('Telefono') }}</label>
            <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror"
                name="telefono" value="{{ old('telefono') }}" required autocomplete="telefono" autofocus>

            @error('telefono')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <label for="password">{{ __('Contraseña') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <label for="password-confirm">{{ __('Confirmar Contraseña') }}</label>

            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                autocomplete="new-password">

            <button type="submit" class="login-button">
                {{ __('Registrar') }}
            </button>
            <a href="{{ route('login') }}" class="create-account">Tengo una cuenta</a>
            <a href="#" class="privacy-policy">Política de privacidad</a>
        </form>
    </div>
</div>