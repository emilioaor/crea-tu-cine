@extends('template.admin')

@section('content')
	
	<div class="container-fluid">
		
		<h2>{{ $movie->title }} - ID: {{ $movie->id }}</h2><hr>

		<div class="row">

			<form action="{{ url('admin/movies/'.$movie->id) }}" enctype="multipart/form-data" method="POST">
			
				<div class="col-md-4">
					<img src="{{ url($movie->image) }}" class="img-reponsive">

					<div class="form-group">
						<label for="file">Cambiar Imagen</label>
						<input type="file" name="file" class="form-control">
					</div>

					<div class="col-md-12 text-center">
						<button type="submit" class="btn btn-success">Actualizar</button>
						<a href="{{ url('admin/movies') }}" class="btn btn-danger">Cancelar</a>
					</div>
				</div>

				<div class="col-md-8">

					{{ csrf_field() }}
					{{ method_field('PUT') }}
					
					<div class="form-group">
						<input type="text" name="title" class="form-control" placeholder="Titulo" value="{{ $movie->title }}" required placeholder="Titulo">
					</div>

					<div class="form-group">
						<textarea name="synopsis" class="form-control" rows="5" placeholder="Sinopsis" required placeholder="Sinopsis">{{ $movie->synopsis }}</textarea>
					</div>

					<div class="form-group">
						<input type="text" name="download" class="form-control" placeholder="Mega" value="{{ $movie->download }}" required placeholder="Mega" placeholder="Mega">
					</div>

					<div class="form-group">
						<input type="text" name="year" class="form-control" placeholder="Año" value="{{ $movie->year }}" required placeholder="Año">
					</div>

					<div class="form-group">
						<input type="text" name="slug" class="form-control" placeholder="Slug" value="{{ $movie->slug }}" required placeholder="slug">
					</div>

					<div class="form-group">
						<input type="text" name="trailer" class="form-control" placeholder="Trailer" value="{{ $movie->trailer }}" required placeholder="Trailer">
					</div>

					<div class="form-group">
						<input type="text" name="online" class="form-control" placeholder="Online" value="{{ $movie->online }}" required placeholder="Online">
					</div>

					<div class="form-group">
						<input type="text" name="uploaded" class="form-control" placeholder="Uploaded" value="{{ $movie->uploaded }}" required placeholder="Uploaded">
					</div>

					<div class="form-group">
						<input type="text" name="turbobit" class="form-control" placeholder="Turbobit" value="{{ $movie->turbobit }}" required placeholder="Turbobit">
					</div>

					<div class="form-group">
						<input type="text" name="thevideos" class="form-control" placeholder="TheVideos" value="{{ $movie->thevideos }}" required placeholder="TheVideos">
					</div>

					<div class="form-group">
						<input type="text" name="thevideos2" class="form-control" placeholder="Thevideos2" value="{{ $movie->thevideos2 }}" required placeholder="TheVideos2">
					</div>

					<div class="form-group">
						<select name="completa" class="form-control">
							@if($movie->completa=='SI')
								<option selected >SI</option>
								<option>NO</option>
							@else
								<option>SI</option>
								<option selected >NO</option>
							@endif
						</select>
					</div>

					<div class="form-group">
						<input type="text" name="id_relation" class="form-control" placeholder="ID de relación" value="{{ $movie->id_relation }}" placeholder="ID Relación">
					</div>


				</div>

			</form>

		</div>


	</div>

@endsection