<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Movie;
use Faker\Provider\tr_TR\DateTime;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;

use App\Cinema;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Style;

class CineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::where('user', $request->user)->get();

        if (isset($request->page) && $request->page == 1) {
            return redirect()->route('cine.user.index', ['user' => $user[0]->user]);
        }

        $cine = Cinema::where('user_id', $user[0]->id)->get();
        $genres = Genre::all();

        if (Auth::check() && Auth::user()->id === $user[0]->id) {
            return redirect()->route('cine.user.admin', ['user' => $user[0]->user]);
        }

        $movies = Movie::where('cine_id', $user[0]->getCinemas[0]->id)->orderBy('year', 'DESC')->orderBy('id','DESC')->paginate(12);
        $styles = $cine[0]->getStyles;

        return view('cine.index')->with(['userUrl' => $user[0]->user, 'movies' => $movies, 'styles' => $styles, 'genres' => $genres, 'cinema' => $cine[0]]);
    }


    /**
     * @param Request $request
     * @return $this
     */
    public function indexGenre(Request $request) {

        $user = User::where('user', $request->user)->get();

        if (isset($request->page) && $request->page == 1) {
            return redirect()->route('cine.user.genre', ['user' => $user[0]->user, 'id' => $request->id]);
        }

        $cine = $user[0]->getCinemas[0];
        $styles = $cine->getStyles;
        $genres = Genre::all();

        $movies = Movie::select('movies.id','movies.title','movies.synopsis','movies.slug','movies.year','movies.image')
            ->join('movies_genres','movies.id','=','movies_genres.movie_id')
            ->join('genres','genres.id','=','movies_genres.genre_id')
            ->where('genres.id',$request->id)
            ->where('movies.cine_id',$cine->id)
            ->orderBy('movies.year','DESC')
            ->paginate(12)
        ;

        return view('cine.index')->with(
            [
                'userUrl' => $user[0]->user,
                'movies' => $movies,
                'styles' => $styles,
                'genres' => $genres,
                'cinema' => $cine,
                'filterGenre' => $request->id,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = User::where('user', $request->user)->get();
        return view('cine.create')->with(['userUrl' => $user[0]->user]);
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

        $cinema = Cinema::where('name',$request->name)->get();
        if (count($cinema)) {
            Session::flash('alert-msg', 'Este nombre de cine esta siendo usado');
            Session::flash('alert-type', 'alert-danger');
            return redirect()->route('cine.user.create', ['user' => $user[0]->user]);
        }

        if($request->image){

            try {

                $originalExtension = $request->image->getClientOriginalExtension();

                if ($originalExtension != 'jpg' && $originalExtension != 'jpeg' && $originalExtension != 'png') {
                    Session::flash('alert-msg', 'La imagen debe ser formato jpg o png');
                    Session::flash('alert-type', 'alert-danger');
                    return redirect()->route('cine.user.create', ['user' => $user[0]->user]);
                }

                $now = new \DateTime();
                $fileName = $user[0]->user . $now->format('d-m-Y h:m:s') . '.' . $originalExtension;

                $cine = new Cinema();
                $cine->name = $request->name;
                $cine->status = Cinema::STATUS_ACTIVE;
                $cine->image = Cinema::DIR_UPLOADS . '/' . $fileName;
                $cine->user_id = $user[0]->id;

                $path = public_path() . '/' . Cinema::DIR_UPLOADS . '/';

                if (!$request->image->move($path, $fileName)) {
                    Session::flash('alert-msg', 'Ocurrio un error al subir archivo');
                    Session::flash('alert-type', 'alert-danger');
                    return redirect()->route('cine.user.create', ['user' => $user[0]->user]);
                }

                $cine->save();
                return redirect()->route('cine.user.index', ['user' => $user[0]->user]);

            } catch (\Exception $ex) {
                Session::flash('alert-msg', 'Ocurrio un error al subir archivo');
                Session::flash('alert-type', 'alert-danger');
            }
        }

        return redirect()->route('cine.user.create', ['user' => $user[0]->user]);
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function admin(Request $request)
    {
        $user = User::where('user', $request->user)->get();

        if (isset($request->page) && $request->page == 1) {
            return redirect()->route('cine.user.admin', ['user' => $user[0]->user]);
        }

        $movies = Movie::where('cine_id', $user[0]->getCinemas[0]->id)->orderBy('year', 'DESC')->orderBy('id','DESC')->paginate(12);
        $cine = $user[0]->getCinemas[0];
        $styles = $cine->getStyles;
        $genres = Genre::all();

        return view('cine.admin')->with(['userUrl' => $user[0]->user, 'movies' => $movies, 'styles' => $styles, 'genres' => $genres, 'cinema' => $cine]);
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function adminGenre(Request $request) {

        $user = User::where('user', $request->user)->get();

        if (isset($request->page) && $request->page == 1) {
            return redirect()->route('cine.user.admin.genre', ['user' => $user[0]->user, 'id' => $request->id]);
        }

        $cine = $user[0]->getCinemas[0];
        $styles = $cine->getStyles;
        $genres = Genre::all();

        $movies = Movie::select('movies.id','movies.title','movies.synopsis','movies.slug','movies.year','movies.image')
                        ->join('movies_genres','movies.id','=','movies_genres.movie_id')
                        ->join('genres','genres.id','=','movies_genres.genre_id')
                        ->where('genres.id',$request->id)
                        ->where('movies.cine_id',$cine->id)
                        ->orderBy('movies.year','DESC')
                        ->orderBy('movies.id','DESC')
                        ->paginate(12)
        ;

        return view('cine.admin')->with(
            [
                'userUrl' => $user[0]->user,
                'movies' => $movies,
                'styles' => $styles,
                'genres' => $genres,
                'cinema' => $cine,
                'filterGenre' => $request->id,
            ]
        );
    }


    /**
     * @param Request $request
     * @return $this
     */
    public function share(Request $request) {
        $user = User::where('user', $request->user)->get();
        $cinema = $user[0]->getCinemas[0];

        return view('cine.share')->with(['userUrl' => $user[0]->user, 'cinema' => $cinema]);
    }


}
