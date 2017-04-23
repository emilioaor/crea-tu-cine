<?php

namespace App\Http\Controllers;

use App\User;
use App\Movie;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RedirectController extends Controller
{

    public function redirectMovie($slug) {

        $user = User::where('user','emilioaor')->get()[0];
        $movie = Movie::where('slug', $slug)->get();

        if (count($movie)) {
            return redirect()->route('cine.user.movies.show', ['user' => $user->user, 'slug' => $slug]);
        }

        abort(404);
    }
}
