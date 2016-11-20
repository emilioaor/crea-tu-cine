<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Controllers\alert;

class authController extends Controller
{
    

    public function login(){

        return view('auth/login');
    }


    public function authenticate(Request $request){



        if(Auth::attempt(['name' => $request->name,'password' => $request->password]) ){
            
            return redirect()->intended('admin/movies');
        }else{
            alert::show('alert-danger','Error al iniciar sesión');
            return redirect('auth/login');
        }
        
    }

    public function logoutUser(){

        Auth::logout();

        return redirect('/');
    }

}
