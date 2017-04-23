@extends('templates.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Cambiar contraseña</h2>
                <hr class="primary">
            </div>
        </div>
        <div class="container">
            <div class="col-md-8 offset-md-2">
                <form action="{{ route('index.password.reset.token.store', ['id' => $id, 'tmp' => $tmp]) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="user">Nueva contraseña</label>
                        <input type="password" name="password" class="form-control" maxlength="20" placeholder="Nueva contraseña" required="required">
                    </div>
                    <div class="form-group">
                        <label for="password">Repetir nueva contraseña</label>
                        <input type="password" name="password2" class="form-control" placeholder="Repetir nueva contraseña" maxlength="20" required="required">
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-lg btn-primary">Cambiar contraseña</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection