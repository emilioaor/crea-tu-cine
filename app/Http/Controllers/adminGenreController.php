<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\movie;
use App\Http\Controllers\alert;

class adminGenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = movie::orderBy('id','DESC')->get();

        $genres = [];

        foreach($movies as $movie){

            for($x=1;$x<=13;$x++){
                $genres[$x] = false;
            }
            
            foreach($movie->genres as $genre){
                $genres[$genre->id] = true;
            }

            $movie->genres = $genres;
        }

        return view('admin/genres/genres')->with('movies',$movies);
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

        $movie->genres()->sync($request->genres);

        alert::show('alert-warning','Generos Actualizados');

        return redirect('admin/genres');
    }

}
