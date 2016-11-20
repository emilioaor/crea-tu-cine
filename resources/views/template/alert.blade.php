@if(Session::has('alert-msj') )
	<div class="container-fluid">
		<div class="alert {{ Session::get('alert-type') }}">
			<p><strong>Atención! </strong> {{ Session::get('alert-msj') }}</p>
		</div>
	</div>
@endif