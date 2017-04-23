@extends('templates.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Bienvenido a la taquilla de cine!</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('cine.all') }}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Buscar cine o película" maxlength="30" required="required" value="{{ Session::has('search') ? Session::get('search') : '' }}">
                        <span class="input-group-btn"><button class="btn btn-primary">Buscar!</button></span>
                    </div>
                </form>
            </div>
        </div>

        @if(Request::has('search'))
            <div class="row" id="spaceResult">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Resultados para cinemas</h5>
                            <div class="row">
                                @if(isset($cinemaResults) && count($cinemaResults))
                                    @foreach($cinemaResults as $cine)
                                        <div class="col-md-3">
                                            <a href="{{ route('cine.user.index', ['user' => $cine->getUser->user]) }}">
                                                <img src="{{ asset($cine->image) }}" class="img-responsive" alt="{{ $cine->name }}" title="{{ $cine->name }}">
                                            </a>
                                            <p class="text-center">
                                                <strong><a href="{{ route('cine.user.index', ['user' => $cine->getUser->user]) }}">{{ $cine->name }}</a></strong><br>
                                                <small><strong>{{ $cine->getUser->user }}</strong></small>
                                            </p>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-md-12">
                                        <p class="text-center"><strong>No ha resultados para cinemas</strong></p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h5>Resultados para películas</h5>
                            <div class="row">
                                @if(isset($movieResults) && count($movieResults))
                                    @foreach($movieResults as $movie)
                                        <div class="col-md-3">
                                            <a href="{{ route('cine.user.movies.show', ['user' => $movie->getCine->getUser->user,'slug' => $movie->slug]) }}">
                                                <img src="{{ asset($movie->image) }}" class="img-responsive" alt="{{ $movie->title }}" title="{{ $movie->title }}">
                                            </a>
                                            <p class="text-center">
                                                <strong><a href="{{ route('cine.user.movies.show', ['user' => $movie->getCine->getUser->user,'slug' => $movie->slug]) }}">{{ $movie->title }}</a></strong><br>
                                                <small><strong>{{ $movie->getCine->name }}</strong></small>
                                            </p>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-md-12">
                                        <p class="text-center"><strong>No ha resultados para películas</strong></p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12" id="lastMovies">
                <h5>Cinemas registrados recientemente</h5>
                <div class="row">
                    @foreach($lastCinemas as $cine)
                        <div class="col-md-3">
                            <a href="{{ route('cine.user.index', ['user' => $cine->getUser->user]) }}">
                                <img src="{{ asset($cine->image) }}" class="img-responsive" alt="{{ $cine->name }}" title="{{ $cine->name }}">
                            </a>
                            <p class="text-center">
                                <strong><a href="{{ route('cine.user.index', ['user' => $cine->getUser->user]) }}">{{ $cine->name }}</a></strong><br>
                                <small><strong>{{ $cine->getUser->user }}</strong></small>
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
@endsection