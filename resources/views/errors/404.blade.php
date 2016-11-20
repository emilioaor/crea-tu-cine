@extends('template.main')

@section('meta')
	<meta property="og:url"           content="http://peliculascineencasa.com" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="Cine en Casa" />
	<meta property="og:description"   content="Ver y descargar películas online en full HD 1080p y audio latino gratis!. Descargas a 1 solo link desde MEGA" />
	<meta property="og:image"         content="http://peliculascineencasa.com/images/banner.jpg" />
@endsection

@section('title')
	@if(Request('page') && Request('page')!='1' )
		{{ Request('page').' - ' }}
	@endif
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
		
		<h2 class="text-center">Error al cargar la página</h2>
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				<img src="{{ url('images/logo.png') }}" class="img-responsive" title="Cine en Casa" alt="Cine en Casa">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<p class="text-justify"><strong>No te preocupes, puede ser que el contenido se moviera a una ubicación diferente o que la ruta este mal escrita. Útiliza el buscador de arriba y encontremos tu película. Sí tienes inconvenientes puedes contactarnos por medio de nuestras redes sociales, abajo las encontraras</strong></p>
			</div>
		</div>
		

	</div>
@endsection