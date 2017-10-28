@extends('templates.base')

@section('meta')
    <meta name="robots" content="noindex">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h3>Registra tu cine</h3>
            </div>
            <form action="{{ route('cine.user.store', ['user' => $userUrl]) }}" class="col-md-12" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-md-8 offset-md-2 form-group">
                    <label for="name">Nombre de tu cine</label>
                    <input type="text" class="form-control" name="name" placeholder="Nombre de tu cine" maxlength="255" required="required">
                </div>
                <div class="col-md-8 offset-md-2 form-group">
                    <label for="image">Imagen</label>
                    <input type="file" class="form-control" name="image" placeholder="Imagen" required="required">
                </div>
                <div class="col-md-12">
                    <div class="form-group text-center">
                        <button class="btn btn-primary">Registrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection