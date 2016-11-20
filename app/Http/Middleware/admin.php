<?php

namespace App\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;
use Closure;
use Auth;

class admin
{

    protected $auth;


    public function __construct(Guard $auth){

        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        

        if( Auth::check() ){
            return $next($request);
        }

      return redirect('auth/login');

    }
}
