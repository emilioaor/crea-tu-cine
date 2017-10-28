@extends('templates.base')

@section('meta')
    <meta name="robots" content="noindex">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Recuperar contraseña</h2>
                <hr class="primary">
            </div>
        </div>
        <div class="container">
            <div class="col-md-8 offset-md-2">
                <form action="{{ route('index.password.reset.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="user">Usuario</label>
                        <input type="text" name="user" class="form-control" maxlength="20" placeholder="Usuario" required="required">
                    </div>
                    <div class="form-group">
                        <label for="password">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" maxlength="80" required="required">
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-lg btn-primary">Recuperar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection