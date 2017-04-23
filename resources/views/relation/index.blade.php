@extends('templates.base')

@section('big-title','<h3 id="homeHeading">Relaciones!</h3>')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Relaciones</h2>
            </div>
            <table class="table" id="table-relation">
                <thead>
                    <tr>
                        <th width="100%">Nombre de la relación</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('cine.user.relation.store', ['user' => $userUrl]) }}" method="post">
                        {{ csrf_field() }}
                        <tr>
                            <td>
                                <input type="text" class="form-control" placeholder="Nombre de la nueva relación" name="name" required="required">
                            </td>
                            <td>
                                <button class="btn btn-success"><span class="fa fa-plus"></span></button>
                            </td>
                        </tr>
                    </form>
                    @foreach($relations as $relation)
                        <form action="{{ route('cine.user.relation.update', ['user' => $userUrl, 'id' => $relation->id]) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <tr>
                                <td>
                                    <input type="text" class="form-control" placeholder="Nombre de la relación" name="name" value="{{ $relation->name }}" required="required">
                                </td>
                                <td>
                                    <button class="btn btn-warning"><span class="fa fa-check"></span></button>
                                </td>
                            </tr>
                        </form>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                {!! $relations->render() !!}
            </div>
        </div>
    </div>
@endsection