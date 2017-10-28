@extends('templates.base')

@section('meta')
    <meta name="robots" content="noindex">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Registrar película</h3>
                <p><small><strong>Marcados con (*) son requeridos</strong></small></p>
            </div>
            <form action="{{ route('cine.user.movies.store', ['user' => $userUrl]) }}" id="registerMovie" class="col-md-12" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-md-6 form-group">
                    <label for="title">Titulo o nombre de la película*</label>
                    <input type="text" class="form-control" name="title" placeholder="Titulo" maxlength="80" value="{{ Session::has('title') ? Session::get('title') : '' }}" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label for="year">Año*</label>
                    <input type="text" class="form-control" name="year" placeholder="Año" maxlength="4" value="{{ Session::has('year') ? Session::get('year') : '' }}" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label for="slug">Titulo que visualiza la URL sin espacios ni caracteres especiales*</label>
                    <input type="text" class="form-control" name="slug" placeholder="ejemplo-titulo-pelicula-url" maxlength="80" value="{{ Session::has('slug') ? Session::get('slug') : '' }}" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label for="image">Imagen. Debe ser cuadrada, preferiblemente 400x400 pixeles*</label>
                    <input type="file" class="form-control" name="image" placeholder="Imagen" maxlength="255" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label for="trailer">Trailer URL</label>
                    <input type="text" id="trailer" class="form-control" name="trailer" placeholder="http://www.trailer.com" value="{{ Session::has('trailer') ? Session::get('trailer') : '' }}" maxlength="255">
                </div>
                <div class="col-md-6 form-group">
                    <label for="relation">Relación <small>(<a href="#" data-toggle="modal" data-target="#myModal">¿Que es esto?</a>)</small></label>
                    <select name="relation" class="form-control">
                        <option value="0">- Ninguna -</option>
                        @foreach($relations as $relation)
                            <option value="{{ $relation->id }}" {{ Session::has('relation') && Session::get('relation') == $relation->id ? 'selected="selected"' : '' }}>{{ $relation->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label for="synopsis">Sinopsis*</label>
                    <textarea name="synopsis" id="synopsis" class="form-control" cols="30" rows="4">{{ Session::has('synopsis') ? Session::get('synopsis') : '' }}</textarea>
                </div>
                <div class="col-md-12 form-group">
                    <h5>Generos</h5>
                    @foreach($genres as $genre)
                        <label for="">{{ $genre->name }}</label>
                        <input type="checkbox" name="genres[]" value="{{ $genre->id }}" {{ Session::has('genre' . $genre->id) ? 'checked' : '' }}> |
                    @endforeach
                </div>
                <div class="col-md-12 form-group">
                    <h4>Opciones online <a href="Javascript:addOnline()">(+)</a></h4>
                    <div id="spaceOnline">
                        @if(Session::has('url_online'))
                            @foreach(Session::get('url_online') as $i => $url)
                                <div class="row rowO{{ $i }}">
                                    <div class="col-md-5 form-group">
                                        <label for="title_url">Titulo del video</label>
                                        <input type="text" class="form-control" name="title_online[]" placeholder="Titulo del video" value="{{ Session::get('title_online')[$i] }}" maxlength="20" required="required">
                                    </div>
                                    <div class="col-md-5 form-group">
                                        <label for="url">Url</label>
                                        <input type="text" class="form-control" name="url_online[]" placeholder="Url" value="{{ $url }}" maxlength="255" required="required">
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <br><a href="Javascript:removeOnline({{ $i }})" class="text-danger">(X)</a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <h4>Opciones de descarga <a href="Javascript:addDownload()">(+)</a></h4>
                    <div id="spaceDownload">
                        @if(Session::has('download_url'))
                            @foreach(Session::get('download_url') as $i => $url)
                                <div class="row rowD{{ $i }}">
                                    <div class="col-md-5 form-group">
                                        <label for="title_url">Titulo del video</label>
                                        <input type="text" class="form-control" name="download_title[]" placeholder="Titulo del video" value="{{ Session::get('download_title')[$i] }}" maxlength="20" required="required">
                                    </div>
                                    <div class="col-md-5 form-group">
                                        <label for="url">Url</label>
                                        <input type="text" class="form-control" name="download_url[]" placeholder="Url" value="{{ $url }}" maxlength="255" required="required">
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <br><a href="Javascript:removeDownload({{ $i }})" class="text-danger">(X)</a>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-md-12 form-group text-center">
                    <button class="btn btn-primary">Registrar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Relations -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Relaciones</h5>
                </div>
                <div class="modal-body">
                    <p>Puedes registrar varias películas que pertenezcan a una misma saga, para esto <strong>crea una relación</strong>.</p>
                    <div class="text-center">
                        <a class="btn" href="{{ route('cine.user.relation.index', ['user' => $userUrl]) }}">Relaciones <span class="fa fa-random"></span></a>
                    </div>
                    <p>Luego asocia las películas a su relación correspondiente.</p>
                    <div class="col-md-12 form-group">
                        <label for="relation">Relación</label>
                        <select name="relation" class="form-control">
                            <option value="0">- Ninguna -</option>
                            @foreach($relations as $relation)
                                <option value="{{ $relation->id }}" {{ Session::has('relation') && Session::get('relation') == $relation->id ? 'selected="selected"' : '' }}>{{ $relation->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <p>Con esto creas una vista de películas relacionadas en cada una de las incluidas en la relación</p>
                    <h7>Películas relacionadas</h7>
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-6">
                                    <img src="{{ asset('images/cineencasa.jpg') }}" width="100%" class="img-responsive" alt="Cine en Casa" title="Cine en Casa">
                                </div>
                                <div class="col-6">
                                    <p><strong>Titulo 1</strong></p>
                                    <p><small>Sinopsis</small></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="row">
                                <div class="col-6">
                                    <img src="{{ asset('images/cineencasa.jpg') }}" width="100%" class="img-responsive" alt="Cine en Casa" title="Cine en Casa">
                                </div>
                                <div class="col-6">
                                    <p><strong>Titulo 2</strong></p>
                                    <p><small>Sinopsis</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Entendido</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/render.js') }}"></script>
@endsection