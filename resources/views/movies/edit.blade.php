@extends('templates.base')

@section('meta')
    <meta name="robots" content="noindex">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>
                    Editar película - {{ $movie->title }}
                    <a href="{{ route('cine.user.movies.show', ['user' => $userUrl, 'slug' => $movie->slug]) }}" class="btn btn-primary">Ver en cine</a>
                </h3>
            </div>
            <form action="{{ route('cine.user.movies.update', ['user' => $userUrl, 'id' => $movie->id]) }}" id="registerMovie" class="col-md-12" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="col-md-6 form-group">
                    <label for="title">Titulo</label>*
                    <input type="text" class="form-control" name="title" value="{{ $movie->title }}" placeholder="Titulo" maxlength="80" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label for="year">Año</label>*
                    <input type="text" class="form-control" name="year" value="{{ $movie->year }}" placeholder="Año" maxlength="4" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label for="slug">Titulo url</label>*
                    <input type="text" class="form-control" name="slug" value="{{ $movie->slug }}" placeholder="ejemplo-titulo-pelicula-url" maxlength="80" required="required">
                </div>
                <div class="col-md-6 form-group">
                    <label for="image">Imagen</label>
                    <input type="file" class="form-control" name="image" placeholder="Imagen" maxlength="255">
                </div>
                <div class="col-md-6 form-group">
                    <label for="trailer">Trailer</label>
                    <input type="text" class="form-control" name="trailer" value="{{ $movie->trailer }}" placeholder="Trailer" maxlength="255">
                </div>
                <div class="col-md-6 form-group">
                    <label for="relation">Relacion</label>
                    <select name="relation" class="form-control">
                        <option value="0">- Ninguna -</option>
                        @foreach($relations as $relation)
                            @if($relation->id == $movie->relation_id)
                                <option value="{{ $relation->id }}" selected="selected">{{ $relation->name }}</option>
                            @else
                                <option value="{{ $relation->id }}">{{ $relation->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label for="synopsis">Sinopsis</label>*
                    <textarea name="synopsis" id="synopsis" class="form-control" cols="30" rows="4">{{ $movie->synopsis }}</textarea>
                </div>
                <div class="col-md-12 form-group">
                    <h5>Generos</h5>
                    @foreach($genres as $genre)
                        <label for="">{{ $genre->name }}</label>
                        @if(in_array($genre->id, $selectedGenres))
                            <input type="checkbox" name="genres[]" value="{{ $genre->id }}" checked="checked"> |
                        @else
                            <input type="checkbox" name="genres[]" value="{{ $genre->id }}"> |
                        @endif
                    @endforeach
                </div>
                <div class="col-md-12 form-group">
                    <h4>Opciones online <a href="Javascript:addOnline()">(+)</a></h4>
                    <div id="spaceOnline">
                        @foreach($movie->getOnlines as $i => $online)
                            <div class="row rowO{{ $i }}">
                                <div class="col-md-5 form-group">
                                    <label for="title_url">Titulo del video</label>
                                    <input type="text" class="form-control" name="title_online[]" placeholder="Titulo del video" value="{{ $online->title_url }}" maxlength="20" required="required">
                                </div>
                                <div class="col-md-5 form-group">
                                    <label for="url">Url</label>
                                    <input type="text" class="form-control" name="url_online[]" placeholder="Url" value="{{ $online->url }}" maxlength="255" required="required">
                                </div>
                                <div class="col-md-2 form-group">
                                    <br><a href="Javascript:removeOnline({{ $i }})" class="text-danger">(X)</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-12 form-group">
                    <h4>Opciones de descarga <a href="Javascript:addDownload()">(+)</a></h4>
                    <div id="spaceDownload">
                        @foreach($movie->getDownloads as $i => $download)
                            <div class="row rowD{{ $i }}">
                                <div class="col-md-5 form-group">
                                    <label for="title_url">Titulo del video</label>
                                    <input type="text" class="form-control" name="download_title[]" placeholder="Titulo del video" value="{{ $download->title }}" maxlength="20" required="required">
                                </div>
                                <div class="col-md-5 form-group">
                                    <label for="url">Url</label>
                                    <input type="text" class="form-control" name="download_url[]" placeholder="Url" value="{{ $download->url }}" maxlength="255" required="required">
                                </div>
                                <div class="col-md-2 form-group">
                                    <br><a href="Javascript:removeDownload({{ $i }})" class="text-danger">(X)</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-12 form-group text-center">
                    <button class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/render.js') }}"></script>
@endsection