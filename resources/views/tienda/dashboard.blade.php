@extends('layouts.app')
@section('content')

<link href="{{ asset('css/Dashboard.css') }}" rel="stylesheet" />
    <div class="dashboard">
    <!--barra lateral-->
    <div class="sidebar">

        <h2>ARCADE_STORE</h2>
        <ul>
            <li><a href="{{ url('admin/dashboard') }}">Inicio</a></li>
            <li><a href="{{ url('admin/juegos') }}">juegos</a></li>
            <li><a href="{{ url('admin/users') }}">usuarios</a></li>
            <li><a href="{{ url('categorias') }}">categorias</a></li>
            <li><a href="{{ url('admin/intercambios') }}">intercambios</a></li>
            <li><a href="{{ url('admin/ventas') }}">ventas</a></li>
            <li><a href=""></a></li>
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

    <!-- info section -->
    <section class="info_section layout_padding2">
        <div class="container">
            <div class="info_items">
                <a href="">
                    <div class="item ">
                        <div class="img-box box-1">
                            <img src="" alt="">
                        </div>
                        <div class="detail-box">
                            <p>
                                SENA
                                CALLE 13 # 65-10
                            </p>
                        </div>
                    </div>
                </a>
                <a href="">
                    <div class="item ">
                        <div class="img-box box-2">
                            <img src="" alt="">
                        </div>
                        <div class="detail-box">
                            <p>
                                +57 3143575304
                            </p>
                        </div>
                    </div>
                </a>
                <a href="">
                    <div class="item ">
                        <div class="img-box box-3">
                            <img src="" alt="">
                        </div>
                        <div class="detail-box">
                            <p>
                                arcadestore@gmail.com
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- end info_section -->
    <!-- footer section-->
<section class="container-fluid footer_section">
    <p> 2024 ALL Rights Reserved By Scrum 3 - SENA-CSF</p>
</section>

</body>
</html>

@endsection