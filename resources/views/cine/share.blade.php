@extends('templates.base')

@section('title','Bievenido a ' . $cinema->name)

@section('og-url','http://peliculascineencasa.com/cine/' . $userUrl . '/share')
@section('og-title',$cinema->name)
@section('og-image','http://peliculascineencasa.com/' . $cinema->image)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Compartir cine</h3>

                <p>Pasa este link a las personas que quieras para que lleguen a este cine</p>
                <div class="form-group">
                    <input type="text" class="form-control" value="{{ route('cine.user.index', ['user' => $userUrl]) }}">
                </div>
            </div>
        </div>
    </div>
@endsection