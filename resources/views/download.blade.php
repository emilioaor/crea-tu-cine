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
		
		<h2 class="text-center">Descargar {{ $movie->title }}</h2><hr>
		<div class="col-md-6 irDownload">
			<a href="{{ $movie->download }}" rel="nofollow" >
				
				<img src="{{ url($movie->image) }}" class="img-responsive" alt="Descargar {{ $movie->title }}" title="Descargar {{ $movie->title }}">

				<p class="text-justify">{{ $movie->synopsis }}</p>
			</a>

			<p class="text-center"><a href="{{ $movie->download }}" rel="nofollow" class="btn btn-primary btn-lg">MEGA</a></p>
		</div>
		<div class="col-md-6">
			<div class="alert alert-info" role="alert">
				<p><strong>¿Sabias que? </strong>Una web requiere gastos de alojamiento, mantenimiento y muchas horas de trabajo y permanece online gracias al apoyo de quienes nos visitan. Una pequeña donación será de gran ayuda para continuar en línea mucho mas tiempo. Ayudanos!</p>
			</div>
			<div class="text-center">
				<a mp-mode="dftl" href="https://www.mercadopago.com/mlv/checkout/start?pref_id=213149413-5f1d12e5-98ff-4841-8a8d-959383fccfec" name="MP-payButton" class='blue-ar-l-rn-none'>Donar 10 bsF</a>
				<script type="text/javascript">
				(function(){function $MPC_load(){window.$MPC_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;s.src = document.location.protocol+"//secure.mlstatic.com/mptools/render.js";var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPC_loaded = true;})();}window.$MPC_loaded !== true ? (window.attachEvent ?window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;})();
				</script>
			</div>
			<div class="text-center">
				<a mp-mode="dftl" href="https://www.mercadopago.com/mlv/checkout/start?pref_id=213149413-9beaacb4-1730-410b-88c1-ddaed50ee284" name="MP-payButton" class='blue-ar-l-rn-none'>Donar 20 bsF</a>
				<script type="text/javascript">
				(function(){function $MPC_load(){window.$MPC_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;s.src = document.location.protocol+"//secure.mlstatic.com/mptools/render.js";var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPC_loaded = true;})();}window.$MPC_loaded !== true ? (window.attachEvent ?window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;})();
				</script>
			</div>
			<div class="text-center">
				<a mp-mode="dftl" href="https://www.mercadopago.com/mlv/checkout/start?pref_id=213149413-fbc279af-b7b9-4269-bf51-db21e1e25a74" name="MP-payButton" class='blue-ar-l-rn-none'>Donar 50 bsF</a>
				<script type="text/javascript">
				(function(){function $MPC_load(){window.$MPC_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;s.src = document.location.protocol+"//secure.mlstatic.com/mptools/render.js";var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPC_loaded = true;})();}window.$MPC_loaded !== true ? (window.attachEvent ?window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;})();
				</script>
			</div>
			<div class="text-center">
				<a mp-mode="dftl" href="https://www.mercadopago.com/mlv/checkout/start?pref_id=213149413-cd216a68-84f0-4505-8efd-b4fa09102fd9" name="MP-payButton" class='blue-ar-l-rn-none'>Donar 100 bsF</a>
				<script type="text/javascript">
				(function(){function $MPC_load(){window.$MPC_loaded !== true && (function(){var s = document.createElement("script");s.type = "text/javascript";s.async = true;s.src = document.location.protocol+"//secure.mlstatic.com/mptools/render.js";var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPC_loaded = true;})();}window.$MPC_loaded !== true ? (window.attachEvent ?window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;})();
				</script>
			</div>
		</div>
	</div>
@endsection