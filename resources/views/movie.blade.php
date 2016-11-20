@extends('template.main')

@section('meta')
	<meta property="og:url"           content="http://peliculascineencasa.com/{{ $movie->slug }}" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="{{ $movie->title }}" />
	<meta property="og:description"   content="{{ $movie->synopsis }}" />
	<meta property="og:image"         content="http://peliculascineencasa.com/{{ $movie->image }}" />
	
	<meta name="Title" content="Ver {{ $movie->title }} online y descargar">
	<meta name="description" content="{{ $movie->title }} película para ver online y descargar por MEGA en HD 1080p y audio latino">
	<meta property="fb:app_id" content="1651000515218750"/>
@endsection

@section('title')
	{{ $movie->title }} ({{ $movie->year }}) online o descargar HD desde 10 bsF
@endsection

@section('jumbotron-h1')
	{{ $movie->title }} online 1080p en audio latino
@endsection

@section('jumbotron-p')
	Venta <strong>{{ $movie->title }} online</strong> para descargar en calidad HD 1080p y audio latino. Descarga disponible por MEGA
@endsection

@section('content')
	<div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.7&appId=1651000515218750";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
	<div class="container-fluid">
		
		<h2 class="text-center">{{ $movie->title }}</h2><hr>
		<div class="row">
			<div class="col-sm-6">
				<img src="{{ url($movie->image) }}" class="img-responsive" alt="{{ $movie->title }} online o descargar" title="{{ $movie->title }} online o descargar">
			</div>
			<div class="col-sm-6">
				<br>
				<p class="text-justify">{{ $movie->synopsis }}<p>
				<p>
					<strong>Genero(s): </strong>
					@foreach($movie->genres as $genre)
						>{{ $genre->name }}
					@endforeach
				</p>
				<p>
					<strong>Calidad: </strong> 1080p
				</p>
				<p>
					<strong>Audio: </strong>Español Latino
				</p>
				<p>
					<strong>Audio Descarga: </strong>Español Latino e ingles subtitulada
				</p>
				<p class="price">
					<strong>Precio: </strong> {{ $movie->price }} bsF
				</p><br>
				@if( !Auth::check() )
					<div class="alert alert-danger" role="alert">
						Debe iniciar sesión para adquirir esta película
					</div>
				@else
					@if($compra)
						<div class="alert alert-success" role="alert">
							Esta película ya esta en su cartelera
						</div>
					@else
						<div class="text-center">
							<a mp-mode="dftl" href="https://www.mercadopago.com/mlv/checkout/start?pref_id=213149413-5f1d12e5-98ff-4841-8a8d-959383fccfec" name="MP-payButton" class='blue-ar-l-rn-none'>Comprar</a>
							<script type="text/javascript">
							(function(){function $MPC_load(){window.$MPC_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;s.src = document.location.protocol+"//secure.mlstatic.com/mptools/render.js";var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPC_loaded = true;})();}window.$MPC_loaded !== true ? (window.attachEvent ?window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;})();
							</script>
						</div>
						<div>
							<form action="">
								<div class="form-group">
									<label for="cod">Código de desbloqueo</label>
									<input type="text" name="cod" class="form-control" placeholder="Código de desbloqueo">
								</div>
								<div class="text-center">
									<button class="btn btn-default">Desbloquear</button>
								</div>
							</form>
						</div>
					@endif
				@endif
			</div>
		</div>
		
		@if($movie->completa=='NO')
			<br>
			<div class="alert alert-danger" role="alert">
				<strong>ATENCION: </strong>
				Por el momento este contenido solo esta disponible para descargar y puede que en menor calidad.
			</div>
		@endif

		@if($compra)

				<div class="row spaceButtons">
					<div class="col-sm-6 col-md-3 text-center"><br><a href="JavaScript:obtenerVideo('{{ url($movie->id.'/video/1') }}')" class="btn btn-primary">Ver Trailer</a></div>

					@if($movie->completa=='SI')
						<div class="col-sm-6 col-md-3 text-center"><br><a href="JavaScript:obtenerVideo('{{ url($movie->id.'/video/2') }}')" class="btn btn-primary">Ver en UpTobox</a></div>
					@endif

					@if($movie->completa=='SI')
						<div class="col-sm-6 col-md-3 text-center"><br><a href="JavaScript:obtenerVideo('{{ url($movie->id.'/video/3') }}')" class="btn btn-primary">Ver en TheVideos</a></div>
					@endif()

					<div class="col-sm-6 col-md-3 text-center"><br><a href="JavaScript:Download()" class="btn btn-primary">Descargar</a></div>	
				</div>

				<div class="row spaceVideo">
					<p class="text-center spaceClose"><a href="JavaScript:closeAll()" class="btn btn-danger">Cerrar</a></p>
					<p class="text-center" id="thevideos2">{!! $movie->thevideos2 !!}</p>
					<div class="col-md-8 col-md-offset-2">
						<div id="spaceVideo" class="embed-responsive embed-responsive-16by9">
						  	
						</div>
					</div>
				</div>

				<div class="loading text-center" id="loading">
					<img src="{{ url('images/loading.gif') }}" class="img-responsive img-limit" >
				</div>

				<div class="row">
					<div class="spaceDownload col-md-12 text-center">
						<p>Seleccione un metodo de descarga.</p>

						@if($movie->download <> ' ')
							<a target="_blank" class="btn btn-default" href="{{ url('download/'.dechex($movie->id) ) }}" rel="nofollow">MEGA</a>
						@endif

						@if($movie->uploaded <> ' ')
							<a target="_blank" class="btn btn-default" href="{{ $movie->uploaded }}" rel="nofollow">Uploaded</a>
						@endif

						@if($movie->turbobit <> ' ')
							<a target="_blank" class="btn btn-default" href="{{ $movie->turbobit }}" rel="nofollow">Turbobit</a>
						@endif
					</div>
				</div>
		
		@endif

		<div class="row">
			<div class="col-md-12">
				<br><h2 class="text-center">Comentarios sobre {{ $movie->title }}</h2>
				<div class="fb-comments" data-href="http://peliculascineencasa.com/{{ $movie->slug }}" data-width="100%" data-numposts="5"></div>
			</div>
		</div>

		@if( isset($moviesRelations) )
			
			<div class="row">
				
				<div class="col-md-12">
					<hr><h3>Películas Relacionadas</h3><hr>
				</div>
				
				@foreach($moviesRelations as $mr)

					<div class="col-xs-12 col-sm-6 movieRelation">
						<div class="row">
							<a href="{{ url($mr->slug) }}">
								<div class="col-sm-6 col-md-4">
									<img src="{{ $mr->image }}" alt="{{ $mr->title }}" title="{{ $mr->title }}" class="img-responsive">
								</div>
								<div class="col-sm-6 col-md-8">
									<h4>{{ $mr->title }}</h4>
									<p class="text-justify">{{ str_limit($mr->synopsis,80) }}</p>
								</div>
							</a>
						</div>
					</div>

				@endforeach

			</div>

		@endif

		<div class="row">
				
			<div class="col-md-12">
				<hr><h3>Películas Recomendadas</h3><hr>
			</div>

			@foreach($moviesRecomendations as $mr)

				<div class="col-xs-12 col-sm-6 movieRelation">
					<div class="row">
						<a href="{{ url($mr->slug) }}">
							<div class="col-sm-6 col-md-4">
								<img src="{{ url($mr->image) }}" alt="{{ $mr->title }}" title="{{ $mr->title }}" class="img-responsive">
							</div>
							<div class="col-sm-6 col-md-8">
								<h4>{{ $mr->title }}</h4>
								<p class="text-justify">{{ str_limit($mr->synopsis,80) }}</p>
							</div>
						</a>
					</div>
				</div>

			@endforeach

		</div>

		


	</div>
@endsection