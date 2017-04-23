<?php

namespace App\Http\Middleware;

use Closure;

use Auth;
use Session;

class OnlyUserCheckMiddleware
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

        return $next($request);
    }
}
