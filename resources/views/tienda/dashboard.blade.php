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
            <p> 50 nuevos usuarios registrados hoy.</p>
            <div class="progress-bar">
            <div class="progress" style="width: 75%;"></div>
            </div>
        </div>

                <div class="card">
                    <h3>Ventas</h3>
                    <p> 120 ventas realizados hoy.</p>
                    <div class="progress-bar">
                        <div class="progress" style="width: 50%;"></div>
                    </div>
                </div>
                        <div class="card">
                            <h3>Ventas con descuentos</h3>
                            <p> 50% hoy.</p>
                            <div class="progress-bar">
                                <div class="progress" style="width: 50%;"></div>
                                </div>
                            </div>
            <!-- grafico circular-->
            <div class="circle-chart">
                <h3>Progreso Total</h3>
                <div class="circle" style="background: conic-gradient(#4CAF50 90%, #f2f2f2 0 100%);"></div>
                <P class="circle-text">90%</P>
            </div>
    </div>
    </div>
</body>


@endsection