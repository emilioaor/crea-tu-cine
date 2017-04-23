@extends('templates.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Entrar</h2>
                <hr class="primary">
            </div>
        </div>
        <div class="container">
            <div class="col-md-8 offset-md-2">
                <form action="{{ route('index.login.user') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="user">Usuario</label>
                        <input type="text" name="user" class="form-control" placeholder="Usuario" value="{{ Session::has('user') ? Session::get('user') : '' }}" maxlength="20" required="required">
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" class="form-control" placeholder="Contraseña" maxlength="80" required="required">
                    </div>
                    <div class="form-group">
                        <a href="{{ route('index.password.reset') }}">Olvide mi contraseña</a>
                    </div>
                    <div class="form-group text-center">
                        <button onclick="" class="btn btn-lg btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection