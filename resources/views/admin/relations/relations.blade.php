@extends('template.admin')

@section('content')
	
	<h2>Relaciones</h2><hr>
	
	<table class="table table-striped">
		<thead>
			<th colspan="3">Agregar</th>
		</thead>
		<tbody>
			<form action="{{ url('admin/relations') }}" method="POST">
				
				{{ csrf_field() }}

				<tr>
					<th colspan="2"><input type="text" name="name" class="form-control" placeholder="Nombre Relacion" required></th>
					<th><button type="submit" class="btn btn-default">Agregar</button></th>
				</tr>

			</form>
		</tbody>
		<thead>
			<th>ID</th>
			<th>Nombre</th>
			<th>Accion</th>
		</thead>
		<tbody>
			@foreach($relations as $relation)

				<form action="{{ url('admin/relations/'.$relation->id) }}" method="POST">

					{{ csrf_field() }}
					{{ method_field('PUT') }}
					
					<tr>
						<th>{{ $relation->id }}</th>
						<th><input type="text" name="name" class="form-control" value="{{ $relation->name }}" required></th>
						<th>
							<button type="submit" class="btn btn-default">Actualizar</button>
						</th>
					</tr>

				</form>

			@endforeach
		</tbody>
	</table>

@endsection