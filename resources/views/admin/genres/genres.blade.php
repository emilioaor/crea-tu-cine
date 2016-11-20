@extends('template.admin')

@section('content')
	
	<h2>Generos</h2>
	<hr>
	<table class="table table-striped">
		<tbody>
			@foreach($movies as $movie)

				<form action="{{ url('admin/genres/'.$movie->id) }}" method="POST">
				
				{{ csrf_field() }}
				{{ method_field('PUT') }}

				<tr>
					<th colspan="8"><h4>{{ $movie->title }}</h4></th>
				</tr>
				<tr>
					<th rowspan="2"><img src="{{ url($movie->image) }}" class="img-responsive img-limit"></th>
					@if($movie->genres[1])
						<th>Comedia <input type="checkbox" name="genres[]" value="1"  checked></th>
					@else
						<th>Comedia <input type="checkbox" name="genres[]" value="1" ></th>
					@endif
					
					@if($movie->genres[2])
						<th>Suspenso <input type="checkbox" name="genres[]" value="2" checked></th>
					@else
						<th>Suspenso <input type="checkbox" name="genres[]" value="2" ></th>
					@endif

					@if($movie->genres[3])
						<th>Drama <input type="checkbox" name="genres[]" value="3" checked></th>
					@else
						<th>Drama <input type="checkbox" name="genres[]" value="3" ></th>
					@endif
					
					@if($movie->genres[4])
						<th>Accion <input type="checkbox" name="genres[]" value="4" checked></th>
					@else
						<th>Accion <input type="checkbox" name="genres[]" value="4" ></th>
					@endif
					
					@if($movie->genres[5])
						<th>Aventura <input type="checkbox" name="genres[]" value="5" checked></th>
					@else
						<th>Aventura <input type="checkbox" name="genres[]" value="5" ></th>
					@endif
					
					@if($movie->genres[6])
						<th>Romance <input type="checkbox" name="genres[]" value="6" checked></th>
					@else
						<th>Romance <input type="checkbox" name="genres[]" value="6" ></th>
					@endif

					@if($movie->genres[7])
						<th>Fantasia <input type="checkbox" name="genres[]" value="7" checked></th>
					@else
						<th>Fantasia <input type="checkbox" name="genres[]" value="7" ></th>
					@endif
				</tr>
				<tr>
					@if($movie->genres[8])
						<th>Infantil <input type="checkbox" name="genres[]" value="8" checked></th>
					@else
						<th>Infantil <input type="checkbox" name="genres[]" value="8" ></th>
					@endif

					@if($movie->genres[9])
						<th>Ficcion <input type="checkbox" name="genres[]" value="9" checked></th>
					@else
						<th>Ficcion <input type="checkbox" name="genres[]" value="9" ></th>
					@endif

					@if($movie->genres[10])
						<th>Terror <input type="checkbox" name="genres[]" value="10" checked></th>
					@else
						<th>Terror <input type="checkbox" name="genres[]" value="10" ></th>
					@endif
					
					@if($movie->genres[11])
						<th>Crimen <input type="checkbox" name="genres[]" value="11" checked></th>
					@else
						<th>Crimen <input type="checkbox" name="genres[]" value="11" ></th>
					@endif

					@if($movie->genres[12])
						<th>Misterio <input type="checkbox" name="genres[]" value="12" checked></th>
					@else
						<th>Misterio <input type="checkbox" name="genres[]" value="12" ></th>
					@endif

					@if($movie->genres[13])
						<th>Animacion <input type="checkbox" name="genres[]" value="13" checked></th>
					@else
						<th>Animacion <input type="checkbox" name="genres[]" value="13" ></th>
					@endif

					<th> <button type="submit" class="btn btn-default">Actualizar</button> </th>

				</tr>
				</form>

			@endforeach
		</tbody>
	</table>

@endsection