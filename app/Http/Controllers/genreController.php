<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\genre;
use App\movie;

class genreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($genre)
    {
        
        $genre = genre::where('name',$genre)->first();
        
        $movies = movie::join('movies_genres','movies.id','=','id_movie')->join('genres','genres.id','=','id_genre')->where('genres.id',$genre->id)->orderBy('year','DESC')->orderBy('movies.id','DESC')->paginate(12);

        $pos = 0;
        foreach($movies as $movie){
            $genres[$pos] = genre::join('movies_genres','id_genre','=','genres.id')->join('movies','id_movie','=','movies.id')->where('movies.id',$movie->id_movie)->get();

            $movie->genres = $genres[$pos];
            $pos++;
        }

        return view('genre/genre')->with('movies',$movies)->with('genre',$genre);

    }

    
}
