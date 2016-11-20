@extends('template.admin')

@section('content')
	
	<div class="container-fluid">
		
		<h2 class="text-center">Panel Administrador</h2><hr>

		<div class="col-md-6 col-md-offset-3">
			<form action="{{ url('auth/authenticate') }}" method="post">

				{{ csrf_field() }}
				
				<div class="form-group">
					<label for="name">Usuario</label>
					<input type="text" class="form-control" name="name" placeholder="Usuario">
				</div>

				<div class="form-group">
					<label for="password">Contraseña</label>
					<input type="password" class="form-control" name="password" placeholder="Contaseña">
				</div>

				<button type="submit" class="btn btn-primary">Ingresar</button>

			</form>
		</div>


	</div>

@endsection