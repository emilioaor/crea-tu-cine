@extends('templates.base')

@section('title', (Request::has('page') && Request::get('page') != 1 ? Request::get('page') . ' - ' : '') . $cinema->name)

@section('og-url','http://peliculascineencasa.com/cine/' . $userUrl)
@section('og-title', $cinema->name)
@section('og-image','http://peliculascineencasa.com/' . $cinema->image)

@section('content')
    @include('templates.dynamic-styles')
    <div class="container">
        <div class="row" id="genres">
            <ul>
                <li><a href="{{ route('cine.user.index', ['user' => $userUrl]) }}" class="{{ isset($filterGenre) ? 'dynamic-link' : 'btn btn-primary' }}">Todo</a></li>
                @foreach($genres as $genre)
                    <li><a href="{{ route('cine.user.genre', ['user' => $userUrl, 'id' => $genre->id]) }}" class="{{ isset($filterGenre) && $filterGenre == $genre->id ? 'btn btn-primary' : 'dynamic-link' }}">{{ $genre->name }}</a></li>
                @endforeach
            </ul>
        </div>

        <div class="row">
            @if(count($movies))
                @foreach($movies as $movie)
                    <div class="col-md-6 col-lg-4 space-movie">
                        <a href="{{ route('cine.user.movies.show', ['user' => $userUrl, 'slug' => $movie->slug]) }}" class="link-border">
                            <div class="movie">
                                <img src="{{ asset($movie->image) }}" alt="{{ $movie->title }}" title="{{ $movie->title }}">
                                <div class="space-syn">
                                    <h4>{{ $movie->title }} ({{ $movie->year }})</h4>
                                    <p>{{ str_limit($movie->synopsis) }}</p>
                                    <p>
                                        <small>
                                            @foreach($movie->getGenres as $genre)
                                                > {{ $genre->name }}
                                            @endforeach
                                        </small>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="col-md-12">
                    <p class="text-center">Sin resultados</p>
                </div>
            @endif

        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                {!! $movies->render() !!}
            </div>
        </div>
    </div>
@endsection