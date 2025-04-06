@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <section class=" slider_section position-relative">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
              @foreach ($juegosDestacados as $index => $juego)
                  <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
              @endforeach
          </ol>
          <div class="carousel-inner">
              @foreach ($juegosDestacados as $index => $juego)
              <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                  <div class="carousel-item-background" style="background-image: url('{{ asset('images/' . $juego->imagen) }}');"></div>
                      <div class="container-fluid">
                          <div class="row">
                              <div class="col-md-4 offset-md-2">
                                  <div class="slider_detail-box">
                                    <h1 style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">
                                      {{ $juego->titulo }}
                                      <br>
                                      <span>
                                          {{ $juego->categoria->nombre_categoria ?? 'Sin Categoría' }}
                                      </span>
                                  </h1>
                                  <p style="text-shadow: 1px 1px 2px rgba(0, 0, 0, 1);">
                                      {{ Str::limit($juego->descripcion, 200) }}
                                  </p>
                                      <div class="btn-box">
                                          <a href="{{ route('tienda.show', $juego->id) }}" class="btn-1">
                                              Compra ahora
                                          </a>
                                      </div>
                                  </div>
                              </div>                                <div class="col-md-6">
                                  <div class="slider_img-box">
                                      <img src="{{ asset('images/' . $juego->imagen) }}" alt="{{ $juego->titulo }}"style=" background-size: cover; background-position: center; background-repeat: no-repeat; height: 700px;">
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              @endforeach
          </div>
      </div>
  </section>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="layout_padding">
        <div class="container">
            <h2 class="custom_heading text-center mb-5">
                <span>
                    Juegos Recientes
                </span>
            </h2>
            @foreach ($juegosRecientes as $index => $juego)
                <section class="about_section layout_padding-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 {{ $index % 2 != 0 ? 'order-md-2' : '' }}">
                                <div class="img-box">
                                    <img src="{{ asset('images/' . $juego->imagen) }}" alt="{{ $juego->titulo }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-box">
                                    <h2 class="custom_heading">
                                        <span>
                                            {{ $juego->titulo }}
                                        </span>
                                    </h2>
                                    <p>
                                        {{ Str::limit($juego->descripcion, 150) }}
                                    </p>
                                    <div>
                                        <a href="{{ route('tienda.show', $juego->id) }}">
                                            Mas informacion
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endforeach
        </div>
    </div>

    <!-- service section 3 -->
  <section class="service_section layout_padding">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 offset-md-2">
          <h2 class="custom_heading">
            NUEVOS <span>JUEGOS</span>
          </h2>
          <div class="container layout_padding2">
            <div class="row">
              <div class="col-md-4">
               <!-- <div class="img_box">
                  <img src="images/s-1.png" alt="">
                </div>-->
                <div class="detail_box">
                  <h6>
                    COMPRA HOY
                  </h6>
                  <p>
                    ¡No te pierdas nuestras ofertas de hoy! Aprovecha increíbles descuentos en una 
                    selección de los mejores videojuegos de PC. Es el momento perfecto para ampliar 
                    tu colección y disfrutar de títulos únicos a precios irresistibles. La promoción 
                    es por tiempo limitado.
                  </p>
                </div>
              </div>
              <div class="col-md-4">
               <!-- <div class="img_box">
                  <img src="images/s-2.png" alt="">
                </div>-->
                <div class="detail_box">
                  <h6>
                    INTERCAMBIA VIDEOJUEGO
                  </h6>
                  <p>
                    ¿Te gustaría probar algo nuevo? Aprovecha nuestra opción de intercambio y renueva 
                    tu colección sin gastar de más. Puedes cambiar tus juegos de PC usados por otros 
                    títulos de igual o menor valor sin costo adicional. Si prefieres un juego de mayor 
                    valor, solo tendrás que pagar la diferencia.
                  </p>
                </div>
              </div>
              <div class="col-md-4">
               <!-- <div class="img_box">
                  <img src="images/s-3.png" alt="">
                </div>-->
                <div class="detail_box">
                  <h6>
                    COTIZA UN JUEGO
                  </h6>
                  <p>
                    ¿Buscas el mejor precio para tu próximo videojuego? Con nuestra opción de 
                    cotización personalizada, no solo te aseguramos el precio ideal, sino que 
                    también puedes aprovechar nuestras ofertas de hoy en una selección única de 
                    títulos de PC. ¡No dejes pasar esta oportunidad para ampliar tu colección!
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div>
            <a href="{{ route('juegosDisp') }}">
              Mas informacion
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end service section -->
   <!-- buy section -->

  <section class="buy_section layout_padding">
    <div class="container">
      <h2>
      ! TE INVITAMOS A CONOCER MAS JUEGOS ¡
      </h2>
      <p>
        Explora nuestro catálogo y encuentra el título perfecto para ti. 
        Reserva o intercambia tus videojuegos con al menos 7 días de anticipación 
        para aprovechar precios especiales y descuentos exclusivos. ¡No te pierdas 
        esta oportunidad de ampliar tu colección y disfrutar de los mejores juegos 
        a precios increíbles!
      </p>
      <div class="d-flex justify-content-center">
       <!-- <a href="">
          Buy Now
        </a>-->
      </div>
    </div>
  </section>

  <!-- end buy section -->

  <!-- client section -->
  <section class="client_section layout_padding-bottom">
    <div class="container">
      <h2 class="custom_heading text-center">
        NUESTROS CLIENTES ESTAN FELICES...
       <!-- <span>
          CIENTES
        </span>-->
      </h2>
      <p class="text-center">
        El 25% de nuestros usuarios consiguió juegos de PC a precios increíbles, ¡por $100.000 
        o menos! Únete a ellos y encuentra los mejores títulos a precios inigualables. No dejes 
        pasar esta oportunidad para ampliar tu colección y disfrutar de grandes aventuras.
      </p>
      <div id="carouselExample2Indicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExample2Indicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExample2Indicators" data-slide-to="1"></li>
          <li data-target="#carouselExample2Indicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="layout_padding2 pl-100">
              <div class="client_container ">
                <div class="img_box">
                 <!--<img src="images/client1.jpg" alt="">-->
                </div>
                <div class="detail_box">
                  <h5>
                    EN LA CIUDAD DE BOGOTA.
                  </h5>
                  <p>
                    una tienda en línea de videojuegos para PC que ofrece una amplia 
                    variedad de títuloS. Con una interfaz 
                    fácil de usar y un proceso de compra rápido, es ideal para quienes buscan descubrir 
                    y adquirir juegos de manera sencilla.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="layout_padding2 pl-100">
              <div class="client_container ">
                <div class="img_box">
                  <!--<img src="images/client1.jpg" alt="">-->
                </div>
                <div class="detail_box">
                  <h5>
                   EN LA CIUDAD DE CUCUTA
                  </h5>
                  <p>
                    su opción de intercambio de juegos es 
                    un plus para renovar tu biblioteca sin gastar demasiado. El servicio al cliente es 
                    eficiente, aunque puede haber pequeños retrasos en horas de alta demanda. En general, 
                    ArcadeStore es una opción confiable y accesible para los gamers.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="layout_padding2 pl-100">
              <div class="client_container ">
                <div class="img_box">
                  <img src="#" alt="">
                </div>
                <div class="detail_box">
                  <h5>
                    EN LA CIUDAD DE CALI
                  </h5>
                  <p>
                    Con un catálogo bien curado de títulos populares y novedades, esta plataforma se posiciona
                    como una opción atractiva para los jugadores que buscan descubrir, comprar e intercambiar
                    videojuegos digitales
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
  <!-- end client section -->
@endsection