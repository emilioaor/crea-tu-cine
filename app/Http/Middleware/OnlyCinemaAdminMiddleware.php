<?php

namespace App\Http\Middleware;

use Closure;

use Auth;
use Session;

use App\User;

class OnlyCinemaAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! Auth::check()) {
            Session::flash('alert-type', 'alert-danger');
            Session::flash('alert-msg', 'Debe iniciar sesión');
            return redirect()->route('index.login');
        }

        $user = User::where('user', $request->user)->get()[0];

        if ($user->id !== Auth::user()->id) {
            Session::flash('alert-type', 'alert-danger');
            Session::flash('alert-msg', 'No tiene permisos para acceder a esta zona');
            return redirect()->route('cine.all');
        }

        return $next($request);
    }
}
