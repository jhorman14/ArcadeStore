@extends('layouts.app')
@section('content')
    <!-- end header section -->
    <!-- slider section -->
    @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

    <section class=" slider_section position-relative">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        <!-- la imagen de fondo sale de Style  background-image: url(../images/hero.jpg);-->
        <div class="carousel-inner">
          <div class="carousel-item active slide1">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-4 offset-md-2">
                  <div class="slider_detail-box">
                    <h1>
                      CALL OF DUTY
                      <br>
                      <span>
                        Black ops 6
                      </span>
                    </h1>
                    <p>
                      Mientras la guerra del Golfo acapara la atención mundial, una tenebrosa fuerza
                      clandestina se ha infiltrado en los niveles más altos de la CIA, tachando de traidores
                      a cualquiera que se resista. Exiliados de su agencia y del país que una vez los aclamó como héroes,
                      Frank Woods, veterano de Black Ops, y su equipo se ven perseguidos por la organización militar que los creó.
                    </p>
                    <div class="btn-box">
                      <a href="{{ url('/juegosDisp') }}" class="btn-1">
                        ver mas
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="slider_img-box">
              <!--  <img src="images/slider-img.png" alt="">-->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item slide2">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-4 offset-md-2">
                  <div class="slider_detail-box">
                    <h1>
                      CALL OF DUTY
                      <span>
                        Modern Warfare 2
                      </span>
                    </h1>
                    <p>
                      los jugadores se verán inmersos en un conflicto a escala global sin precedentes
                      que incluye el regreso de operadores icónicos de la fuerza operativa 141.
                      Infinity Ward ofrece a los fans una experiencia puntera con un manejo nuevo,
                      un sistema de IA avanzado, un armero nuevo y una retahíla de innovaciones gráficas
                      y de jugabilidad que elevarán la franquicia a otro nivel.
                    </p>
                    <div class="btn-box">
                      <a href="{{ url('/juegosDisp') }}" class="btn-1">
                        ver mas
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="slider_img-box">
                <!--   <img src="images/slider-img.png" alt="">-->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item slide3">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-4 offset-md-2">
                  <div class="slider_detail-box">
                    <h1>
                      BLACK MYTH
                      <br>
                      <span>
                        Wukong
                      </span>
                    </h1>
                    <p>
                      Un RPG de acción inspirado en la mitología china. Emprenderás la travesía como el Destinado,
                      enfrentarás desafíos, conocerás maravillas y descubrirás la oscura verdad que yace bajo el engañoso
                      velo de una gloriosa leyenda ancestral, inspirada en la clásica novela Viaje al Oeste, encarnando al
                      Rey Mono, un personaje mítico con habilidades sobrenaturales.
                    </p>
                    <div class="btn-box">
                      <a href="{{ url('/juegosDisp') }}" class="btn-1">
                        ver mas
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="slider_img-box">
                  <!--  <img src="images/slider-img.png" alt="">-->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item slide4">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-4 offset-md-2">
                  <div class="slider_detail-box">
                    <h1>
                      ASSASSIN'S
                      <br>
                      <span>
                        Creed III
                      </span>
                    </h1>
                    <p>
                      Revive la revolución estadounidense o vívela por primera vez
                      controlando a Connor en la remasterización de Assassin's Creed® III,
                      con gráficos mejorados y una mecánica de juego mejorada. Además, se
                      incluye Assassin's Creed® III Liberation Remasterizado y todo el contenido
                      DLC individual, El quinto título principal de la popular saga de juegos de acción en mundo
                      abierto

                    </p>
                    <div class="btn-box">
                      <a href="{{ url('/juegosDisp') }}" class="btn-1">
                        ver mas
                      </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="slider_img-box">
                <!--    <img src="images/slider-img.png" alt="">-->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- end slider section -->
  </div>


  <!-- about section -->

  <section class="about_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="img-box">
            <img src="images/GTA.png" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <h2 class="custom_heading">
              <span>
              GTA V
              </span>
            </h2>
            <p>
              Un joven estafador callejero, un ladrón de bancos retirado y un psicópata 
              aterrador se ven involucrados con lo peor y más desquiciado del mundo criminal, 
              del gobierno de los EE. UU. y de la industria del espectáculo, y tendrán que 
              llevar a cabo una serie de peligrosos golpes para sobrevivir en una ciudad 
              implacable en la que no pueden confiar en nadie. Y mucho menos los unos en los otros.
            </p>
            <div>
              <a href="{{ url('/juegosDisp') }}">
                ver mas
              </a>
            </div>
          <!--  <div>
              <a href="">
                About More
              </a>
            </div>-->
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- service section -->

     <!-- about section 2 -->

  <section class="about_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="detail-box">
            <h2 class="custom_heading">
              Prince of Persia: 
              <br>
              <span>
                The Lost Crown
              </span>
            </h2>
            <p>
              Adéntrate en un elegante juego de plataformas repleto de acción y 
              aventura. Viaja por la mitología persa y manipula los límites del
              espacio y el tiempo. ¡Controla a Sargón y pasa de ser un prodigio
              de la espada a toda una leyenda! Domina un combate ágil y desbloquea
              nuevos poderes del tiempo y habilidades especiales únicas que se
              acomoden a tu estilo de juego.
            </p>
            <div>
              <a href="{{ url('/juegosDisp') }}">
                ver mas
              </a>
            </div>
          <!--  <div>
              <a href="">
                About More
              </a>
            </div>-->
          </div>
        </div>
        <div class="col-md-6">
          <div class="img-box">
            <img src="images/Prince.png" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- service section 2 -->

    <!-- about section 3 -->

    <section class="about_section layout_padding">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="img-box">
              <img src="images/TEKKEN.png" alt="">
            </div>
          </div>
          <div class="col-md-6">
            <div class="detail-box">
              <h2 class="custom_heading">
                <span>
                  Tekken 8
                </span>
              </h2>
              <p>
                Tras derrotar a su padre, Heihachi Mishima, Kazuya continúa su conquista por la 
                dominación global, utilizando las fuerzas de la Corporación G para detonar la 
                guerra en el mundo.

                Jin se ve obligado a enfrentarse a su destino cuando se reencuentra con su
                desaparecida madre e intenta detener el reino de terror de su padre Kazuya.
              </p>
              <div>
                <a href="{{ url('/juegosDisp') }}">
                  ver mas
                </a>
              </div>
            <!--  <div>
                <a href="">
                  About More
                </a>
              </div>-->
            </div>
          </div>
        </div>
      </div>
    </section>
  
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
            <a href="">
              Mas informacion
            </a>
          </div>
        </div>
        <div class="col-md-4">
          <img src="images/play.jpeg" alt="" class="w-100">
        </div>
      </div>
    </div>
  </section>

  <!-- end service section -->

  <!-- gallery section -->
  <section class="gallery-section layout_padding">
    <div class="container">
      <h2>
        NUESTA COLECCION.
      </h2>
    </div>
    <div class="container ">
      <div class="img_box box-1">
        <img src="images/col-1.jpg" alt="">
      </div>
      <div class="img_box box-2">
        <img src="images/col-2.jpg" alt="">
      </div>
      <div class="img_box box-3">
        <img src="images/col-3.jpg" alt="">
      </div>
      <div class="img_box box-4">
        <img src="images/col-4.jpg" alt="">
      </div>
      <div class="img_box box-5">
        <img src="images/col-5.jpg" alt="">
      </div>
    </div>
  </section>



  <!-- end gallery section -->

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



