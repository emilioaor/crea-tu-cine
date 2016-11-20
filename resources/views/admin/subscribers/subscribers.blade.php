@extends('template.admin')

@section('content')
	
	<h2>Suscriptores: {{ count($subscribers) }}</h2><hr>
	
	<h4>Destinatarios</h4>
	<input type="text" class="form-control" value="@foreach($subscribers as $subscriber){{ htmlentities($subscriber->email) }};@endforeach">

	<h4>HTML del correo</h4>
	<textarea class="form-control" rows="15"></textarea>
	

@endsection