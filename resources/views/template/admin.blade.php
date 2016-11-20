<!DOCTYPE html>
<html lang="es">
<head>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	@yield('meta')
	<meta name="robots" content="noindex">
	<link rel="icon" type="image/png" href="{{ url('images/icono.png') }}" />
	<meta charset="UTF-8">
	<title>Administrador</title>
	<link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ url('css/admin.css') }}">
</head>
<body>
	<script src="{{ url('js/admin.js') }}"></script>
	
	<header>
		<div class="container">
			<h1>
				Bienvenido @if(Auth::check() ) {{ Auth::user()->name }} @endif
			</h1>
		</div>
	</header>

	<section class="container-fluid">
		
		<div class="row">
		
			@if(Auth::check() )

				<section class="panel col-md-2">
				
					<div class="menu">
						<h4>Menú Administrador</h4><hr>
						<ul>
							<li><a href="{{ url('admin/movies') }}" class="btn btn-primary">Películas</a></li>
							<li><a href="{{ url('admin/genres') }}" class="btn btn-primary">Generos</a></li>
							<li><a href="{{ url('admin/relations') }}" class="btn btn-primary">Relaciones</a></li>
							<li><a href="{{ url('admin/subscribers') }}" class="btn btn-primary">Suscriptores</a></li>
							<li><a href="{{ url('admin/movies/links') }}" class="btn btn-primary">Enlaces</a></li>
							<li><a href="{{ url('auth/logout') }}" onclick="return confirm('¿Salir?')" class="btn btn-primary">Salir</a></li>
						</ul>
					</div>
				
				</section>
			@endif

			<section class="main col-md-10">
				@include('template.alert')
				@yield('content')
			</section>

		</div>

	</section>
		
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="{{ url('js/bootstrap.min.js') }}"></script>
</body>
</html>