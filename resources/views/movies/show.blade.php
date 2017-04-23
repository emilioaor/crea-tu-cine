@extends('templates.base')

@section('content')
    @include('templates.dynamic-styles')
    <div class="container" id="movieShow">
        <div class="row" id="detail">
            <div class="col-md-12">
                <h2 class="text-center">
                    {{ $movie->title }} ({{ $movie->year }})
                    @if(Auth::check() && Auth::user()->user === $userUrl)
                        <a href="{{ route('cine.user.movies.edit', ['user' => $userUrl, 'slug' => $movie->slug]) }}" class="btn btn-primary">Editar</a>
                    @endif
                </h2>
            </div>
            <div class="col-md-6">
                <img src="{{ asset($movie->image) }}" class="img-responsive" alt="">
            </div>
            <div class="col-md-6">
                <p>{{ $movie->synopsis }}</p>
                <p>
                    <strong>Generos:</strong><br>
                    <small>
                        @foreach($movie->getGenres as $genre)
                            > {{ $genre->name }}
                        @endforeach
                    </small>
                </p>
                <p>
                    <input type="hidden" id="tokenLike" name="tokenLike" value="{{ csrf_token() }}">
                    @if(Auth::check())

                        @if($movie->isLiked())
                            <a href="Javascript:like('{{ $userUrl }}', '{{ $movie->slug }}')" id="like" class="btn-like-clicked">Like <span class="fa fa-2x fa-thumbs-up"></span></a> <span id="numLike">{{ count($movie->getUsersLikes) }}</span>
                        @else
                            <a href="Javascript:like('{{ $userUrl }}', '{{ $movie->slug }}')" id="like" class="btn-like">Like <span class="fa fa-2x fa-thumbs-up"></span></a> <span id="numLike">{{ count($movie->getUsersLikes) }}</span>
                        @endif

                    @else
                        Like <span class="fa fa-2x fa-thumbs-up"></span> <span id="numLike">{{ count($movie->getUsersLikes) }}</span>
                        <br>
                        Solo usuarios registrados pueden dar like. Registrar <a href="{{ route('index.index') }}#contact">ahora</a> o <a href="{{ route('index.login') }}">login</a> si ya tienes cuenta

                    @endif
                </p>
                @if(! Auth::check())
                    <p>¿Te gustaría crear <strong>tu propio cine online</strong>?. Regístrate <a href="{{ route('index.index') }}#contact">ahora</a></p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" id="buttons">

                <div class="row">
                    <div class="col-md-4">
                        <h6><strong>Trailer:</strong></h6>
                        @if($movie->trailer != null && $movie->trailer != '')
                            <div class="text-center">
                                <button onclick="Javascript:renderOnlineVideo('{{ $movie->trailer }}')" class="btn btn-outline-primary">Ver trailer</button>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <h6><strong>Ver online:</strong></h6>
                        @foreach($movie->getOnlines as $online)
                            <div class="text-center">
                                <button onclick="Javascript:renderOnlineVideo('{{ $online->url }}')" class="btn btn-outline-primary">{{ $online->title_url }}</button>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-4">
                        <h6><strong>Descarga:</strong></h6>
                        @foreach($movie->getDownloads as $download)
                            <div class="text-center">
                                <a href="{{ route('cine.user.movies.download', ['user' => $userUrl, 'slug' => $movie->slug, 'id' => $download->id]) }}" target="_blank" class="btn btn-outline-primary">{{ $download->title }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12" id="spaceVideo">

            </div>
        </div>

        @if(count($relations))
            <div class="row" id="relation">
                <div class="col-md-12">
                    <h5>Películas relacionadas</h5>
                </div>
                @foreach($relations as $relation)
                    <div class="col-md-6">

                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset($relation->image) }}" alt="">
                            </div>
                            <div class="col-md-8">
                                <a href="{{ route('cine.user.movies.show', ['user' => $userUrl, 'slug' => $relation->slug]) }}" class="dynamic-link"><h6>{{ $relation->title }}</h6></a>
                                <p class="text-justify">{{ str_limit($relation->synopsis) }}</p>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

        <div class="row" id="comments">
            <div class="col-md-12">
                <h5>Comentarios sobre "<strong>{{ $movie->title }}</strong>"</h5>

                @foreach($movie->getLastComments() as $comment)
                    <div class="spaceComment">
                        <p><strong>{{ $comment->getUser ? $comment->getUser->user : 'Anónimo' }} dice:</strong></p>
                        <p>{{ $comment->content }}</p>
                    </div>
                @endforeach

                <form action="{{ route('cine.user.movies.comment.send', ['user' => $userUrl, 'slug' => $movie->slug]) }}" method="post">
                    {{ csrf_field() }}
                    @if(!Auth::check())
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email" required="required" maxlength="80">
                        </div>
                    @endif
                    <div class="form-group">
                        <textarea name="content" id="content" cols="30" rows="5" class="form-control" placeholder="Escribir nuevo comentario ..." required="required" maxlength="255"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-outline-primary">Enviar comentario</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script src="{{ asset('js/movie.js') }}"></script>
    <script src="{{ asset('js/like.js') }}"></script>
@endsection