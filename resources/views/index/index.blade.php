<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Crea tu propio cine online y conviertelo en el mas popular">
    <meta name="description" content="Crea tu propio cine online con tus películas favoritas hasta convertirlo en el mas popular">
    <meta name="author" content="Emilio Ochoa">
    <link rel="icon" type="image/png" href="{{ asset('images/icono.png') }}" />
    <meta property="og:url"           content="http://peliculascineencasa.com" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Cine en Casa" />
    <meta property="og:description"   content="Crea tu propio cine online con tus películas favoritas hasta convertirlo en el mas popular" />
    <meta property="og:image"         content="http://peliculascineencasa.com/images/banner.jpg" />

    <title>Crea tu propio cine online</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="{{ asset('vendor/magnific-popup/magnific-popup.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/creative.css') }}" rel="stylesheet">
    <link href="{{ asset('css/other.css') }}" rel="stylesheet">

    <!-- Temporary navbar container fix -->
    <style>
        .navbar-toggler {
            z-index: 1;
        }

        @media (max-width: 576px) {
            nav > .container {
                width: 100%;
            }
        }
    </style>

</head>

<body id="page-top">

<!-- Google Analytics -->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-70129542-6', 'auto');
    ga('send', 'pageview');
</script>

<!-- Navigation -->
<nav class="navbar fixed-top navbar-toggleable-md navbar-light" id="mainNav">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarExample" aria-controls="navbarExample" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="container">
        <a class="navbar-brand" href="#page-top">Cine en Casa</a>
        <div class="collapse navbar-collapse" id="navbarExample">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('index.login') }}">Entrar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">Ver mas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#services">Pasos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#portfolio">Cines</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Registro</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<header class="masthead">
    <div class="header-content">
        <div class="header-content-inner">
            <h1 id="homeHeading">Cine en Casa</h1>
            <hr>
            <p>Crea y administra tu propio cine gratis desde la comodidad de tu hogar!</p>
            <a class="btn btn-primary btn-xl" href="#about">Ver mas</a>
        </div>
    </div>
</header>

<section class="bg-primary" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <h2 class="section-heading text-white">Crea tu propio cine online!</h2>
                <hr class="light">
                <p class="text-faded">Carga tu cine con todas tus películas favoritas y difundelas entre todos tus amigos hasta convertirlo en el mas popular!</p>
                <a class="btn btn-default btn-xl sr-button" href="#services">INICIAR!</a>
            </div>
        </div>
    </div>
</section>

<section id="services">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">¿Como lo consigo?</h2>
                <hr class="primary">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box">
                    <i class="fa fa-4x fa-list text-primary sr-icons"></i>
                    <h3>Registrate</h3>
                    <p class="text-muted">Crea una cuenta abajo en el formulario de registro.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box">
                    <i class="fa fa-4x fa-cog text-primary sr-icons"></i>
                    <h3>Personaliza tu cine</h3>
                    <p class="text-muted">Agrega a tu cine tu estilo propio de colores e imágenes!</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box">
                    <i class="fa fa-4x fa-upload text-primary sr-icons"></i>
                    <h3>Publica contenido</h3>
                    <p class="text-muted">Carga todas tus películas favoritas para que se vean en tu cine.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="service-box">
                    <i class="fa fa-4x fa-share text-primary sr-icons"></i>
                    <h3>Comparte</h3>
                    <p class="text-muted">Convierte a tu cine en popular difundiendo tanto como puedas!</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="no-padding" id="portfolio">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Cines creados recientemente!</h2>
                <hr>
            </div>
        </div>
        <div class="row no-gutter">
            @foreach($cinemas as $cine)
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="{{ route('cine.user.index', ['user' => $cine->getUser->user]) }}">
                        <img  src="{{ asset($cine->image) }}" class="img-responsive" alt="{{ $cine->name }}" title="{{ $cine->name }}">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    {{ $cine->getUser->user }}
                                </div>
                                <div class="project-name">
                                    {{ $cine->name }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<div class="call-to-action bg-dark">
    <div class="container text-center">
        <a class="btn btn-default btn-xl sr-button" href="#contact">Crear el mio ahora!</a>
    </div>
</div>

<section id="contact">
    <div class="container">
        @if(Session::has('alert-msg') && Session::has('alert-type'))
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="alert {{ Session::get('alert-type') }} alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {!! Session::get('alert-msg') !!}
                    </div>
                    <br>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <h2 class="section-heading">Registra tu cine gratis!</h2>
                <hr class="primary">
                <p>Con solo registrarte en la web podras publicar tantas películas como quieras y compartirlas con todos tus amigos. Demuestra que tu cine puede ser el mas popular!</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div id="alert-contact"></div>
                <form action="{{ route('index.register') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <span id="alert-user" class="alert-form"></span>
                        <input type="text" class="form-control" id="user" name="user" placeholder="Usuario" maxlength="20" value="{{ Session::has('user') ? Session::get('user') : '' }}" required="required">
                    </div>
                    <div class="form-group">
                        <span id="alert-password" class="alert-form"></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" maxlength="20" required="required">
                    </div>
                    <div class="form-group">
                        <span id="alert-password2" class="alert-form"></span>
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Repetir contraseña" maxlength="20" required="required">
                    </div>
                    <div class="form-group">
                        <span id="alert-email" class="alert-form"></span>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" maxlength="80" value="{{ Session::has('email') ? Session::get('email') : '' }}" required="required">
                    </div>
                    <div class="form-group">
                        <span id="alert-cine-name" class="alert-form"></span>
                        <input type="text" class="form-control" id="cine_name" name="cine_name" placeholder="Nombre de su cine" maxlength="20" value="{{ Session::has('cine_name') ? Session::get('cine_name') : '' }}" required="required">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-lg btn-primary">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p class="text-center">&copy Copyright Cine en Casa 2017 - Desarrollado por:  <a href="https://emilioochoa.com.ve" target="_blank">Emilio Ochoa</a></p>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/tether/tether.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- Plugin JavaScript -->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('vendor/scrollreveal/scrollreveal.min.js') }}"></script>
<script src="{{ asset('vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>

<!-- Custom scripts for this template -->
<script src="{{ asset('js/creative.min.js') }}"></script>

</body>

</html>