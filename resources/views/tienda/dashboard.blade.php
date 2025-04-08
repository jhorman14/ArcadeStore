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
            <h3>Progreso Ventas</h3>
            @php
                $percentage = isset($stats['percentage_games_sold']) ? $stats['percentage_games_sold'] : 0;
                $color = '#4CAF50'; // Default green
                if ($percentage < 50) {
                    $color = '#FFC107'; // Yellow for less than 50%
                }
                if ($percentage < 25) {
                    $color = '#F44336'; // Red for less than 25%
                }
            @endphp
            <div class="circle" style="background: conic-gradient({{ $color }} {{ $percentage }}%, #f2f2f2 0 100%); width: 100px; height: 100px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                <P class="circle-text" style="position: relative; top: 0; font-weight: bold; font-size: 1.2em;">{{ $percentage }}%</P>
            </div>
        </div>


        <div class="card">
            <h3>Intercambios</h3>
            <p id="total-intercambios">
                Total de Intercambios Realizados: {{ isset($stats['total_intercambios']) ? $stats['total_intercambios'] : '0' }}
            </p>
            <div class="progress-bar">
                <div class="progress" style="width: {{ isset($stats['total_intercambios']) ? $stats['total_intercambios'] : '0' }}%;"></div>
            </div>
        </div>
        <div class="card">
            <h3>Juegos</h3>
            <p id="total-games">
                Total de Juegos: {{ isset($stats['total_games']) ? $stats['total_games'] : '0' }}
            </p>
            <div class="progress-bar">
                <div class="progress" style="width: {{ isset($stats['total_games']) ? $stats['total_games'] : '0' }}%;"></div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/admin-dashboard.js') }}"></script>
</body>


@endsection
