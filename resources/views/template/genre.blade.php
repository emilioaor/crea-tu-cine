@extends('template.main')

@section('meta')
	<meta property="og:url"           content="http://peliculascineencasa.com" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="Cine en Casa" />
	<meta property="og:description"   content="Venta de películas para descargar genero @yield('genre') online en full HD 1080p y audio latino!. Descargas a 1 solo link desde MEGA" />
	<meta property="og:image"         content="http://peliculascineencasa.com/images/banner.jpg" />
@endsection

@section('title')
	@if(Request('page') && Request('page')!='1' )
		{{ Request('page').' - ' }}
	@endif
	Venta de Peliculas desde 10 bsF genero @yield('genre') Online para Descargar HD
@endsection

@section('jumbotron-h1')
	Venta de películas desde 10 bsF para descargar genero @yield('genre') online HD 1080p audio latino
@endsection

@section('jumbotron-p')
	Venta de tus películas favoritas desde 10 bsF genero @yield('genre') en línea todas disponibles para ver y descargar en full HD 1080p audio latino 1 solo link MEGA!. Compra un sin fin de horas de películas desde la comodidad de tu hogar.
@endsection

@section('content')
	<div class="container-fluid">
		<h2 class="text-center">@yield('genre')</h2>
		<div class="row">
			@foreach($movies as $movie)
				<div class="spaceMovie col-xs-6 col-sm-4 col-lg-3">
					<div class="movie">
						<a href="{{ url($movie->slug) }}">
							<img src="{{ url($movie->image) }}" class="img-responsive" alt="Película: {{ $movie->title }} online o descargar" title="Película: {{ $movie->title }} online o descargar">
							<h3 class="text-center">{{ str_limit($movie->title,10) }}</h3>
							<p class="text-justify">
								<strong>{{ $movie->title }} ({{ $movie->year }})</strong><br><br>
								{{ str_limit($movie->synopsis,130) }}
								<br>
								@foreach($movie->genres as $genres)
										<br> >{{ $genres->name }}
								@endforeach
							</p>
						</a>
					</div>
				</div>
			@endforeach
		</div>
		<div class="row">
			<div class="col-md-12 text-center">
				{!! $movies->render() !!}
			</div>
		</div>
	</div>
@endsection