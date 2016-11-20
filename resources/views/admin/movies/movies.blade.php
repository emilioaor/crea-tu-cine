@extends('template.admin')

@section('content')
	
	<h2>Lista de Películas</h2><hr>
	<a href="{{ url('admin/movies/create') }}" class="btn btn-success">
		<span class="glyphicon glyphicon-plus"></span>
	</a>
	<hr>
	<table class="table table-striped">
		<thead>
			<th>ID</th>
			<th>Imagen</th>
			<th>Titulo</th>
			<th>Mega</th>
			<th>Acción</th>
		</thead>
		<tbody>
			@foreach($movies as $movie)

				<tr>
					<th>{{ $movie->id }}</th>
					<th><img src="{{ url($movie->image) }}" class="img-responsive img-limit"></th>
					<th>{{ $movie->title }}</th>
					<th>
						<input type="text" id="download{{ $movie->id }}" class="form-control" value="{{ $movie->download }}">
						<button type="button" id="btnFast" onclick="updateFasts({{ $movie->id }})" class="btn btn-default"><small>Actualizar</small></button>
						<img src="{{ url('images/loading.gif') }}" id="imgFast{{ $movie->id }}" class="imgFast">
					</th>
					<th>
						<a href="{{ url('admin/movies/'. $movie->id .'/edit') }}" class="btn btn-warning">Editar</a>
					</th>
				</tr>

			@endforeach
		</tbody>
	</table>

@endsection