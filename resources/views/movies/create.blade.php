@extends('templates.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Registrar película</h3>
            </div>
            <form action="{{ route('cine.user.movies.store', ['user' => $userUrl]) }}" id="registerMovie" class="col-md-12" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-md-6 form-group">
                    <label for="title">Titulo</label>*
                    <input type="text" class="form-control" name="title" placeholder="Titulo" maxlength="80" value="{{ Session::has('title') ? Session::get('title') : '' }}" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label for="year">Año</label>*
                    <input type="text" class="form-control" name="year" placeholder="Año" maxlength="4" value="{{ Session::has('year') ? Session::get('year') : '' }}" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label for="slug">Titulo url</label>*
                    <input type="text" class="form-control" name="slug" placeholder="ejemplo-titulo-pelicula-url" maxlength="80" value="{{ Session::has('slug') ? Session::get('slug') : '' }}" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label for="image">Imagen</label>*
                    <input type="file" class="form-control" name="image" placeholder="Imagen" maxlength="255" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label for="trailer">Trailer</label>
                    <input type="text" id="trailer" class="form-control" name="trailer" placeholder="http://www.trailer.com" value="{{ Session::has('trailer') ? Session::get('trailer') : '' }}" maxlength="255">
                </div>
                <div class="col-md-6 form-group">
                    <label for="relation">Relacion</label>
                    <select name="relation" class="form-control">
                        <option value="0">- Ninguna -</option>
                        @foreach($relations as $relation)
                            <option value="{{ $relation->id }}" {{ Session::has('relation') && Session::get('relation') == $relation->id ? 'selected="selected"' : '' }}>{{ $relation->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label for="synopsis">Sinopsis</label>*
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
@endsection

@section('js')
    <script src="{{ asset('js/render.js') }}"></script>
@endsection