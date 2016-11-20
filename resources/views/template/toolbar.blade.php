<header>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				@if( Auth::check() ) <p><strong>{{ Auth::user()->name }} | Saldo: </strong> {{ Auth::user()->saldo }} bsF</p> @endif
			</div>
			<div class="col-md-6">
				@if( Auth::check() )
					<p class="text-right"><a href="{{ url('auth/logout') }}">Salir</a></p>
				@else
					<p class="text-right"><a href="{{ url('auth/login') }}">Iniciar Sessión</a> | <a href="#">Registrar</a></p>
				@endif
			</div>
		</div>
	</div>
</header>