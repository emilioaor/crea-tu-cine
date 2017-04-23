<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use DB;
use Auth;

use App\User;
use App\Movie;
use App\Cinema;
use App\Online;
use App\Download;
use App\Genre;
use App\Relation;
use App\Comment;


class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::where('user', $request->user)->get();
        $movies = Movie::where('cine_id', $user[0]->getCinemas[0]->id)->orderBy('year', 'DESC')->paginate(30);

        return view('movies.index', ['userUrl' => $user[0]->user, 'movies' => $movies]);
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function create(Request $request)
    {
        $user = User::where('user', $request->user)->get();
        $genres = Genre::all();
        $relations = Relation::where('cine_id', $user[0]->getCinemas[0]->id)->get();
        return view('movies.create')->with(['userUrl' => $user[0]->user, 'genres' => $genres, 'relations' => $relations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('title', $request->title);
        Session::flash('year', $request->year);
        Session::flash('slug', $request->slug);
        Session::flash('relation', $request->relation);
        Session::flash('synopsis', $request->synopsis);
        Session::flash('relation', $request->relation);
        Session::flash('genres', $request->genres);

        if (isset($request->trailer)) {
            Session::flash('trailer', $request->trailer);
        }

        if (isset($request->genres)) {
            foreach ($request->genres as $genre) {
                Session::flash('genre' . $genre, $genre);
            }
        }

        if (isset($request->url_online)) {
            Session::flash('url_online', $request->url_online);
            Session::flash('title_online', $request->title_online);
        }

        if (isset($request->download_url)) {
            Session::flash('download_url', $request->download_url);
            Session::flash('download_title', $request->download_title);
        }

        DB::beginTransaction();
        $user = User::where('user', $request->user)->get();
        $cinema = Cinema::where('user_id', $user[0]->id)->get();

        if (! $this->requestValidation($request, Cinema::initRegisterValidationParams())) {
            Session::flash('alert-msg', implode('<br>', $this->getRequestErrors()));
            Session::flash('alert-type', 'alert-danger');
            DB::rollback();
            return redirect()->route('cine.user.movies.create', ['user' => $user[0]->user]);
        }

        $slugMovie = Movie::where('slug', $request->slug)->get();
        if (count($slugMovie)) {
            Session::flash('alert-msg', 'El slug ya esta en uso');
            Session::flash('alert-type', 'alert-danger');
            DB::rollback();
            return redirect()->route('cine.user.movies.create', ['user' => $user[0]->user]);
        }

        if($request->image){

            try {

                $originalExtension = $request->image->getClientOriginalExtension();
                $originalName = $request->image->getClientOriginalName();

                if ($originalExtension != 'jpg' && $originalExtension != 'jpeg' && $originalExtension != 'png') {
                    Session::flash('alert-msg', 'La imagen debe ser formato jpg o png');
                    Session::flash('alert-type', 'alert-danger');
                    DB::rollback();
                    return redirect()->route('cine.user.movies.create', ['user' => $user[0]->user]);
                }

                $now = new \DateTime();
                $fileName = $user[0]->user . $now->format('d-m-Y h:m:s') . '.' . $originalExtension;

                $movie = new Movie($request->all());
                $movie->status = Movie::STATUS_ACTIVE;
                $movie->cine_id = $cinema[0]->id;
                $movie->image = Movie::DIR_UPLOADS . '/' . $fileName;
                $movie->relation_id = $request->relation > 0 ? $request->relation : null;
                $movie->save();

                if (count($request->genres)) {
                    $movie->getGenres()->sync($request->genres);
                }

                $errors = [];
                if (isset($request->title_online) && count($request->title_online) && isset($request->url_online) && count($request->url_online)) {
                    foreach ($request->title_online as $i => $title) {
                        $online = new Online();
                        $online->title_url = $title;
                        $online->url = $request->url_online[$i];
                        $online->status = Online::STATUS_ACTIVE;
                        $online->movie_id = $movie->id;
                        $online->save();

                        if (! preg_match('/^(http|https)\:\/\/[a-z0-9\.-]+\.[a-z]{2,4}/i', $online->url)) {
                            $errors[] = 'Opcion online ' . ($i + 1) . ' no contiene un formato correcto de url';
                        }
                    }
                }

                if (isset($request->download_title) && count($request->download_title) && isset($request->download_url) && count($request->download_url)) {
                    foreach ($request->download_title as $i => $title) {
                        $download = new Download();
                        $download->title = $title;
                        $download->url = $request->download_url[$i];
                        $download->status = Download::STATUS_ACTIVE;
                        $download->movie_id = $movie->id;
                        $download->save();

                        if (! preg_match('/^(http|https)\:\/\/[a-z0-9\.-]+\.[a-z]{2,4}/i', $download->url)) {
                            $errors[] = 'Opcion descarga ' . ($i + 1) . ' no contiene un formato correcto de url';
                        }
                    }
                }

                if (count($errors)) {
                    Session::flash('alert-msg', implode('<br>', $errors));
                    Session::flash('alert-type', 'alert-danger');
                    DB::rollback();
                    return redirect()->route('cine.user.movies.create', ['user' => $user[0]->user]);
                }

                $path = public_path() . '/' . Movie::DIR_UPLOADS . '/';

                $size = filesize($path);
                $info = getimagesize($_FILES['image']['tmp_name']);

                if ($info[0] != $info[1]) {
                    Session::flash('alert-msg', 'La imágen no es cuadrada');
                    Session::flash('alert-type', 'alert-danger');
                    DB::rollback();
                    return redirect()->route('cine.user.movies.create', ['user' => $user[0]->user]);
                }

                if ($size > (1024 * 1024)) {
                    Session::flash('alert-msg', 'La imagen no puede pesar mas de 1 MB');
                    Session::flash('alert-type', 'alert-danger');
                    DB::rollback();
                    return redirect()->route('cine.user.movies.create', ['user' => $user[0]->user]);
                }


                if (!$request->image->move($path, $fileName)) {
                    Session::flash('alert-msg', 'Ocurrio un error al subir archivo');
                    Session::flash('alert-type', 'alert-danger');
                    DB::rollback();
                    return redirect()->route('cine.user.movies.create', ['user' => $user[0]->user]);
                }


                Session::flash('alert-msg', 'Película cargada correctamente');
                Session::flash('alert-type', 'alert-success');
                DB::commit();
                return redirect()->route('cine.user.movies.edit', ['user' => $user[0]->user, 'slug' => $movie->slug]);

            } catch (\Exception $ex) {
                Session::flash('alert-msg', 'Ocurrio un error al subir archivo');
                Session::flash('alert-type', 'alert-danger');
                DB::rollback();
            }
        }

        return redirect()->route('cine.user.movies.create', ['user' => $user[0]->user]);
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function show(Request $request)
    {
        $user = User::where('user', $request->user)->get();
        $movie = Movie::where('cine_id', $user[0]->getCinemas[0]->id)->where('slug', $request->slug)->get()[0];
        $styles = $user[0]->getCinemas[0]->getStyles;

        if (isset($movie->relation_id) && $movie->relation_id > 0) {
            $relations = Movie::where('relation_id', $movie->relation_id)->where('id','<>',$movie->id)->get();
        }

        if (count($movie)) {
            return view('movies.show')
                ->with([
                    'userUrl' => $user[0]->user,
                    'movie' => $movie,
                    'relations' => isset($relations) ? $relations : [],
                    'styles' => $styles
                ]);
        }

        return redirect('cine.user.movies.index');
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit(Request $request)
    {
        $user = User::where('user', $request->user)->get();
        $movie = Movie::where('slug', $request->slug)->where('cine_id', $user[0]->getCinemas[0]->id)->get()[0];
        $genres = Genre::all();
        $relations = Relation::where('cine_id', $user[0]->getCinemas[0]->id)->get();
        $selectedGenres = [];
        foreach($movie->getGenres as $genre) {
            $selectedGenres[] = $genre->id;
        }

        if (count($movie)) {
            return view('movies.edit')->with([
                'userUrl' => $user[0]->user,
                'genres' => $genres,
                'relations' => $relations,
                'movie' => $movie,
                'selectedGenres' => $selectedGenres
            ]);
        }

        return redirect('cine.user.movies.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $movie = Movie::find($request->id);
        $user = User::where('user', $request->user)->get();

        if (! $this->requestValidation($request, Cinema::initRegisterValidationParams())) {
            Session::flash('alert-msg', implode('<br>', $this->getRequestErrors()));
            Session::flash('alert-type', 'alert-danger');
            DB::rollback();
            return redirect()->route('cine.user.movies.edit', ['user' => $user[0]->user, 'slug' => $movie->slug]);
        }

        if (!$movie) {
            Session::flash('alert-msg', 'No existe la película');
            Session::flash('alert-type', 'alert-danger');
            return redirect()->route('cine.user.movies.index', ['user' => $user[0]->user]);
        }

        DB::beginTransaction();

        $cinema = Cinema::where('user_id', $user[0]->id)->get();
        $slugMovie = Movie::where('slug', $request->slug)->where('cine_id', $cinema[0]->id)->get();

        if (count($slugMovie) && $request->slug !== $movie->slug) {
            Session::flash('alert-msg', 'El slug debe ser unico');
            Session::flash('alert-type', 'alert-danger');
            DB::rollback();
            return redirect()->route('cine.user.movies.edit', ['user' => $user[0]->user, 'slug' => $request->slug]);
        }

        $movie->update($request->all());

        if (count($request->genres)) {
            $movie->getGenres()->sync($request->genres);
        } else {
            foreach ($movie->getGenres as $i => $genre) {
                $movie->getGenres()->detach($genre->id);
            }
        }

        $movie->relation_id = $request->relation > 0 ? $request->relation : null;

        foreach ($movie->getOnlines as $online) {
            $online->delete();
        }

        foreach ($movie->getDownloads as $download) {
            $download->delete();
        }

        $errors = [];
        if (isset($request->title_online) && count($request->title_online) && isset($request->url_online) && count($request->url_online)) {
            foreach ($request->title_online as $i => $title) {
                $online = new Online();
                $online->title_url = $title;
                $online->url = $request->url_online[$i];
                $online->status = Online::STATUS_ACTIVE;
                $online->movie_id = $movie->id;
                $online->save();

                if (! preg_match('/^(http|https)\:\/\/[a-z0-9\.-]+\.[a-z]{2,4}/i', $online->url)) {
                    $errors[] = 'Opcion online ' . ($i + 1) . ' no contiene un formato correcto de url';
                }
            }
        }

        if (isset($request->download_title) && count($request->download_title) && isset($request->download_url) && count($request->download_url)) {
            foreach ($request->download_title as $i => $title) {
                $download = new Download();
                $download->title = $title;
                $download->url = $request->download_url[$i];
                $download->status = Download::STATUS_ACTIVE;
                $download->movie_id = $movie->id;
                $download->save();

                if (! preg_match('/^(http|https)\:\/\/[a-z0-9\.-]+\.[a-z]{2,4}/i', $download->url)) {
                    $errors[] = 'Opcion descarga ' . ($i + 1) . ' no contiene un formato correcto de url';
                }
            }
        }

        if (count($errors)) {
            Session::flash('alert-msg', implode('<br>', $errors));
            Session::flash('alert-type', 'alert-danger');
            DB::rollback();
            return redirect()->route('cine.user.movies.edit', ['user' => $user[0]->user, 'slug' => $request->slug]);
        }

        if($request->image){

            try {

                $originalExtension = $request->image->getClientOriginalExtension();
                $originalName = $request->image->getClientOriginalName();

                if ($originalExtension != 'jpg' && $originalExtension != 'jpeg' && $originalExtension != 'png') {
                    Session::flash('alert-msg', 'La imagen debe ser formato jpg o png');
                    Session::flash('alert-type', 'alert-danger');
                    DB::rollback();
                    return redirect()->route('cine.user.movies.edit', ['user' => $user[0]->user, 'slug' => $request->slug]);
                }

                $now = new \DateTime();
                $fileName = $user[0]->user . $now->format('d-m-Y h:m:s') . '.' . $originalExtension;

                $movie->image = Movie::DIR_UPLOADS . '/' . $fileName;

                $path = public_path() . '/' . Movie::DIR_UPLOADS . '/';

                $size = filesize($path);
                $info = getimagesize($_FILES['image']['tmp_name']);

                if ($info[0] != $info[1]) {
                    Session::flash('alert-msg', 'La imágen no es cuadrada');
                    Session::flash('alert-type', 'alert-danger');
                    DB::rollback();
                    return redirect()->route('cine.user.movies.edit', ['user' => $user[0]->user, 'slug' => $request->slug]);
                }

                if ($size > (1024 * 1024)) {
                    Session::flash('alert-msg', 'La imagen no puede pesar mas de 1 MB');
                    Session::flash('alert-type', 'alert-danger');
                    DB::rollback();
                    return redirect()->route('cine.user.movies.edit', ['user' => $user[0]->user, 'slug' => $request->slug]);
                }

                if (!$request->image->move($path, $fileName)) {
                    Session::flash('alert-msg', 'Ocurrio un error al subir archivo');
                    Session::flash('alert-type', 'alert-danger');
                    DB::rollback();
                }

            } catch (\Exception $ex) {
                Session::flash('alert-msg', 'Ocurrio un error al subir archivo');
                Session::flash('alert-type', 'alert-danger');
                DB::rollback();
                return redirect()->route('cine.user.movies.edit', ['user' => $user[0]->user, 'slug' => $request->slug]);
            }

        }

        $movie->save();
        Session::flash('alert-msg', 'Película actualizada correctamente');
        Session::flash('alert-type', 'alert-success');
        DB::commit();
        return redirect()->route('cine.user.movies.edit', ['user' => $user[0]->user, 'slug' => $request->slug]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function download(Request $request) {

        $download = Download::find($request->id);
        $url = 'http://adf.ly/11273555/' . $download->url;

        return redirect($url);
    }


    public function all(Request $request) {

        $lastCinemas = Cinema::orderBy('id', 'DESC')->limit(8)->get();

        if (isset($request->search) && $request->search != '') {

            Session::flash('search', $request->search);

            if (strlen($request->search) < 3) {
                Session::flash('alert-type', 'alert-danger');
                Session::flash('alert-msg', 'Ingrese al menos 3 caracteres');
                return view('movies.all')->with(['lastCinemas' => $lastCinemas]);
            }

            $search = str_replace(' ', '%', $request->search);
            $search = '%' . $search . '%';
            $cinemaResults = Cinema::where('name','like',$search)->limit(8)->get();
            $movieResults = Movie::where('title','like',$search)->limit(8)->get();
        }

        return view('movies.all')->with(
            [
                'lastCinemas' => $lastCinemas,
                'cinemaResults' => isset($cinemaResults) ? $cinemaResults : array(),
                'movieResults' => isset($movieResults) ? $movieResults : array(),
            ]
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendComment(Request $request) {

        $user = User::where('user', $request->user)->get();
        $movie = Movie::where('cine_id', $user[0]->getCinemas[0]->id)->where('slug', $request->slug)->get()[0];

        $comment = new Comment($request->all());
        $comment->movie_id = $movie->id;
        $comment->status = Comment::STATUS_ACTIVE;
        $comment->user_id = Auth::check() ? Auth::user()->id : null;
        $comment->save();

        return redirect()->route('cine.user.movies.show', ['user' => $user[0]->user, 'slug' => $movie->slug]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function like(Request $request) {

        $user = User::where('user', $request->user)->get();
        $movie = Movie::where('cine_id', $user[0]->getCinemas[0]->id)->where('slug', $request->slug)->get()[0];
        $count = count($movie->getUsersLikes);


        foreach ($movie->getUsersLikes as $like) {

            if ($like->pivot->user_id == Auth::user()->id) {
                $movie->getUsersLikes()->detach(Auth::user()->id);
                $count--;

                return new JsonResponse(['ok' => true, 'action' => 'dislike', 'count' => $count]);
            }
        }

        $movie->getUsersLikes()->attach(Auth::user()->id);
        $count++;

        return new JsonResponse(['ok' => true, 'action' => 'like', 'count' => $count]);

    }
}
