<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\movie;
use App\Http\Controllers\alert;


class moviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $movies = movie::orderBy('id','DESC')->get();

        return view('admin.movies.movies')->with('movies',$movies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/movies/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->file){
            
            $movie = new movie( $request->all() );
            if($movie->id_relation == '') $movie->id_relation=null;

            $path = public_path().'/imagesMovies/';
            $name = $request->file->getClientOriginalName();

            $movie->image = 'imagesMovies/'.$name;

            if( $request->file->move($path,$name) ){
                alert::show('alert-success','Película agregada correctamente');
                $movie->save();
            }

        }else{
            alert::show('alert-info','Debe cargar una imagen');
        }

        return redirect('admin/movies');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie = movie::find($id);

        return view('admin.movies.edit')->with('movie',$movie);
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
        $movie = movie::find($id);
        $movie->fill( $request->all() );

        if($movie->id_relation == '') $movie->id_relation=null;
        $movie->save();
        alert::show('alert-warning','Película Actualizada');

        if($request->file){
            $path = 'imagesMovies';
            $name = $request->file->getClientOriginalName();

            $request->file->move($path,$name);
        }

        return redirect('admin/movies/'. $id .'/edit');

    }

    
    public function show(){

        $links = movie::select('download')->get();

        return view('admin/movies/links')->with('links',$links);
    }


    public function fast(Request $data){

        $movie = movie::find($data->id);
        $movie->download = $data->download;
        $movie->save();
    }
}
