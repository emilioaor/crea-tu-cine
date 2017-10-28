<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="@yield('meta-title','Crea tu propio cine online y conviertelo en el mas popular')">
    <meta name="description" content="@yield('meta-description','Crea tu propio cine online con tus películas favoritas hasta convertirlo en el mas popular')">
    <meta name="author" content="Emilio Ochoa">
    <meta property="og:url"           content="@yield('og-url','http://peliculascineencasa.com')" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="@yield('og-title','Cine en Casa')" />
    <meta property="og:description"   content="@yield('og-description','Crea tu propio cine online con tus películas favoritas hasta convertirlo en el mas popular')" />
    <meta property="og:image"         content="@yield('og-image','http://peliculascineencasa.com/images/banner.jpg')" />
    @yield('meta')

    <title>@yield('title','Cine en Casa')</title>

    <link rel="icon" type="image/png" href="{{ asset('images/icono.png') }}" />

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
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

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

@if(Auth::check())
    @include('templates.navAuth')
@else
    @include('templates.nav')
@endif

<header class="masthead">
    <div class="header-content">
        <div class="header-content-inner">
            <h1 id="homeHeading">
                @inject('user','App\User')
                {{ isset($userUrl) ? $user::getCinemaFromUsername($userUrl) : 'Cine en Casa' }}
            </h1>
        </div>
    </div>
</header>

<section id="main">
    @if(Auth::check() && isset($userUrl) && Auth::user()->user === $userUrl)
        @include('templates.buttonsAuth')
    @elseif(isset($userUrl))
        @include('templates.buttons')
    @endif
    @if(Session::has('alert-msg') && Session::has('alert-type'))
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="alert {{ Session::get('alert-type') }} alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {!!  Session::get('alert-msg') !!}
                    </div>
                    <br>
                </div>
            </div>
        </div>
    @endif
    @yield('content')
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

@yield('js')

</body>

</html>