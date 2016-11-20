<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\movie;
use App\subscriber;

class indexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $movies = movie::Search($request->title)->orderBy('year','DESC')->orderBy('id','DESC')->paginate(12); 
        return view('index')->with('movies',$movies);
    }

    public function movie($slug)
    {
        $movie = movie::where('slug',$slug)->first();

        if( count($movie)>0 ){

            //Obtener peliculas Recomendadas
            $codGenre = $movie->genres->first()->id;
            
            $moviesRecomendations = movie::join('movies_genres','movies.id','=','id_movie')->join('genres','genres.id','=','id_genre')->where('genres.id','=',$codGenre)->where('movies.id','<>',$movie->id)->orderBy('year','DESC')->orderBy('movies.id','DESC')->get()->take(4);


            //Verificar si tiene relacion
            if( !is_null($movie->id_relation) ){
                //Obtener películas relacionadas
                $moviesRelations = movie::where('id_relation',$movie->id_relation)->where('id','<>',$movie->id)->orderBy('year','DESC')->get();

                return view('movie')->with('movie',$movie)->with('moviesRecomendations',$moviesRecomendations)->with('moviesRelations',$moviesRelations);
            }

            return view('movie')->with('movie',$movie)->with('moviesRecomendations',$moviesRecomendations);

        }else{
            return redirect('error/404');
        }

    }


    public function video($id,$video){

        $movie = movie::find($id);
        $data = [];

        if($video==1){
            $data['thevideos'] = $movie->trailer;
            $data['thevideos2'] = 'NO';
        }
        elseif($video==2){
            $data['thevideos'] = $movie->online;
            $data['thevideos2'] = 'NO';
        }elseif($video==3){
            $data['thevideos'] = $movie->thevideos;
            $data['thevideos2'] = $movie->thevideos2;
        }

        return $data;
    }


    public function suscription(Request $request){

        $control = subscriber::where('email',$request->email)->get();

        if( count($control) == 0 ){

            $subscriber = new subscriber($request->all());
            $subscriber->save();
        }

        return redirect('subscriber/agradecimientos');
    }


    public function graxx(){
        return view('agradecimientos');
    }


    public function download($id){

        $movie = movie::find( hexdec("$id") );

        return view('download')->with('movie',$movie);
    }

    public function error404(){

        return view('errors/404');
    }

}
