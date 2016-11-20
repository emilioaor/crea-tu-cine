@extends('template.admin')

@section('content')
	
	<h2>Lista de enlaces</h2><hr>
	
	<div class="col-md-10 col-md-offset-1">
		
		<textarea  rows="25" class="form-control">@foreach($links as $link){{ $link->download."\n" }}@endforeach</textarea>
	</div>
@endsection