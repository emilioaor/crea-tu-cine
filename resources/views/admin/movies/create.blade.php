@extends('template.admin')

@section('content')
	
	<div class="container-fluid">
		
		<h2>Agregar Película</h2><hr>

		<div class="row">

			<form action="{{ url('admin/movies') }}" enctype="multipart/form-data" method="POST">
			
				<div class="col-md-4">
					<img src="{{ url('images/logo.png') }}" class="img-reponsive">

					<div class="form-group">
						<label for="file">Subir Imagen</label>
						<input type="file" name="file" class="form-control" required>
					</div>

					<div class="col-md-12 text-center">
						<button type="submit" class="btn btn-success">Agregar</button>
						<a href="{{ url('admin/movies') }}" class="btn btn-danger">Cancelar</a>
					</div>
				</div>

				<div class="col-md-8">

					{{ csrf_field() }}
					
					<div class="form-group">
						<input type="text" name="title" class="form-control" placeholder="Titulo" required>
					</div>

					<div class="form-group">
						<textarea name="synopsis" class="form-control" rows="5" placeholder="Sinopsis" required></textarea>
					</div>

					<div class="form-group">
						<input type="text" name="download" class="form-control" placeholder="Mega" required>
					</div>

					<div class="form-group">
						<input type="text" name="year" class="form-control" placeholder="Año" required>
					</div>

					<div class="form-group">
						<input type="text" name="slug" class="form-control" placeholder="Slug" required>
					</div>

					<div class="form-group">
						<input type="text" name="trailer" class="form-control" placeholder="Trailer" required>
					</div>

					<div class="form-group">
						<input type="text" name="online" class="form-control" placeholder="Online" required>
					</div>

					<div class="form-group">
						<input type="text" name="uploaded" class="form-control" placeholder="Uploaded" required>
					</div>

					<div class="form-group">
						<input type="text" name="turbobit" class="form-control" placeholder="Turbobit" required>
					</div>

					<div class="form-group">
						<input type="text" name="thevideos" class="form-control" placeholder="TheVideos" required>
					</div>

					<div class="form-group">
						<input type="text" name="thevideos2" class="form-control" placeholder="Thevideos2" required>
					</div>

					<div class="form-group">
						<select name="completa" class="form-control">
							<option>SI</option>
							<option>NO</option>
						</select>
					</div>

					<div class="form-group">
						<input type="text" name="id_relation" class="form-control" placeholder="ID de relación">
					</div>


				</div>

			</form>

		</div>


	</div>

@endsection