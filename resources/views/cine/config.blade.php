@extends('templates.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Configuración</h3>
                <br>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('cine.user.config.update', ['user' => $userUrl]) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <h5>Estilos</h5>
                    <div class="row">
                        @foreach($cinema->getStyles as $style)
                            <div class="col-sm-3">
                                <div class="form-group text-center">
                                    <label for="{{ $style->name }}">{{ $style->label }}</label><br>
                                    <input type="color" name="styles[{{ $style->name }}]" value="{{ $style->value }}">
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <br>
                                <button class="btn btn-primary">Guardar cambios</button>
                                <br><br>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" title="Restaurar configuración">Config por defecto</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row" id="spaceLogoChange">
            <div class="col-md-12">
                <form action="{{ route('cine.user.config.image.update', ['user' => $userUrl]) }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ asset($cinema->image) }}" class="img-responsive" alt="{{ $cinema->title }}" title="{{ $cinema->title }}">
                        </div>
                        <div class="col-md-8">
                            <h5>Imagen de portada</h5>
                            <div class="form-group">
                                <input type="file" class="form-control" name="image" required="required">
                                <p><strong>La imágen debe ser cuadrada. Preferiblemente 400x400 pixeles y pesar menos de 1 megabyte</strong></p>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary">Cargar imagen</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('cine.user.config.password', ['user' => $userUrl]) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <h5>Cambio de contraseña</h5>
                    <div class="form-group">
                        <input type="password" class="form-control" name="old_password" placeholder="Contraseña actual" required="required">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Nueva contraseña" required="required">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password2" placeholder="Repetir nueva contraseña" required="required">
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-primary">Cambiar contraseña</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Styles -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Restaurar configuración <span class="fa fa-exclamation"></span></h4>
                </div>
                <div class="modal-body">
                    <p>¿Esta seguro de restaurar la configuración por defecto?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('cine.user.config.restore', ['user' => $userUrl]) }}" method="post" id="formRestore">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group text-center">
                                    <button class="btn btn-danger">Si</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection