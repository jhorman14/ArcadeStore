@extends('layouts.app')
@section('content')

<link href="{{ asset('css/Dashboard.css') }}" rel="stylesheet" />
<link href="{{ asset('css/stylef.css') }}" rel="stylesheet" />
    <div class="dashboard">
    <!--barra lateral-->
    <div class="sidebar">
        <ul>
            <li><a href="{{ url('admin/juegos') }}">juegos</a></li>
            <li><a href="{{ url('admin/users') }}">usuarios</a></li>
            <li><a href="{{ url('categorias') }}">categorias</a></li>
            <li><a href="{{ url('admin/intercambios') }}">intercambios</a></li>
            <li><a href="{{ url('admin/ventas') }}">ventas</a></li>
            
        </ul>
    </div>

    <!-- contenido principal -->
    <div class="main-content">
        <div class="card">
            <h3>Usuarios</h3>
            <p id="total-users">
                Total de Usuarios Registrados: {{ isset($stats['total_users']) ? $stats['total_users'] : '0' }}
            </p>
            <div class="progress-bar">
                <div class="progress" style="width: {{ isset($stats['total_users']) ? $stats['total_users'] : '0' }}%;"></div>
            </div>
        </div>

        <div class="card">
            <h3>Ventas</h3>
            <p id="total-games-sold">
                Total de Juegos Vendidos: {{ isset($stats['total_games_sold']) ? $stats['total_games_sold'] : '0' }}
            </p>
            <div class="progress-bar">
                <div class="progress" style="width: {{ isset($stats['total_games_sold']) ? $stats['total_games_sold'] : '0' }}%;"></div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/admin-dashboard.js') }}"></script>
</body>


@endsection
