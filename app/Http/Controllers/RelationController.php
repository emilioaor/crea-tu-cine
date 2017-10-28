<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Relation;
use App\User;
use App\Cinema;
use Illuminate\Support\Facades\Session;

class RelationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::where('user', $request->user)->get();
        $cinema = Cinema::where('user_id', $user[0]->id)->get();
        $relations = Relation::where('cine_id', $cinema[0]->id)->orderBy('id','DESC')->paginate(25);

        return view('relation.index')->with(['userUrl' => $user[0]->user, 'relations' => $relations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::where('user', $request->user)->get();
        $cinema = Cinema::where('user_id', $user[0]->id)->get();

        $relation = new Relation($request->all());
        $relation->cine_id = $cinema[0]->id;
        $relation->save();

        Session::flash('alert-msg', 'Relacion registrada');
        Session::flash('alert-type', 'alert-success');
        return redirect()->route('cine.user.relation.index', ['user' => $user[0]->user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::where('user', $request->user)->get();

        $relation = Relation::find($request->id);
        $relation->update($request->all());

        Session::flash('alert-msg', 'Relacion actualizada');
        Session::flash('alert-type', 'alert-success');
        return redirect()->route('cine.user.relation.index', ['user' => $user[0]->user]);
    }

}
