<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\relation;
use App\Http\Controllers\alert;

class relationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $relations = relation::orderBY('id','DESC')->get();

        return view('admin/relations/relations')->with('relations',$relations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $relation = new relation($request->all() );
        $relation->save();
        alert::show('alert-success','Relación Creada');

        return redirect('admin/relations');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $relation = relation::find($id);
        $relation->fill($request->all() );
        $relation->save();
        alert::show('alert-warning','Relación Actualizada');

        return redirect('admin/relations');
    }

}
