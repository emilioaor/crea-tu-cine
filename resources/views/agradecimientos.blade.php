@extends('template.main')

@section('meta')
	<meta property="og:url"           content="http://peliculascineencasa.com" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="Cine en Casa" />
	<meta property="og:description"   content="Ver y descargar películas online en full HD 1080p y audio latino gratis!. Descargas a 1 solo link desde MEGA" />
	<meta property="og:image"         content="http://peliculascineencasa.com/images/banner.jpg" />
	<meta name="robots" content="noindex">
@endsection

@section('title')
	Ver Peliculas Online o Descargar HD gratis
@endsection

@section('jumbotron-h1')
	Ver y descargar películas online HD 1080p audio latino gratis
@endsection

@section('jumbotron-p')
	Tus películas favoritas en línea todas disponibles para ver y descargar en full HD 1080p audio latino 1 solo link MEGA gratis!. Tenemos para ti un sin fin de horas de películas desde la comodidad de tu hogar.
@endsection

@section('content')
	<div class="container-fluid">
		
		<h2>Suscripción Completa</h2><hr>
		<p>Gracias por suscribirte en la web, recibiras un email cada sabado con todas las películas publicadas durante la semana.</p>
		<p>Para volver a la lista de películas has click <a href="{{ url('/') }}">aqui</a></p>
	</div>
@endsection