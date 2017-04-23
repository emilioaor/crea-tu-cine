@extends('templates.base')

@section('content')
    <div class="container">
        <div class="row">
            <table width="100%" class="table" id="list">
                <thead>
                    <tr>
                        <th></th>
                        <th>Titulo</th>
                        <th>Slug</th>
                        <th>Año</th>
                        <th>Relación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($movies as $movie)
                        <tr>
                            <td><img src="{{ asset($movie->image) }}" alt=""></td>
                            <td><a href="{{ route('cine.user.movies.edit', ['user' => $userUrl, 'slug' => $movie->slug]) }}">{{ $movie->title }}</a></td>
                            <td>{{ $movie->slug }}</td>
                            <td>{{ $movie->year }}</td>
                            <td>{{ $movie->getRelationMovie ? $movie->getRelationMovie->name : '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                {!! $movies->render()  !!}
            </div>
        </div>
    </div>
@endsection