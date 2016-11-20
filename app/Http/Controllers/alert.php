<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;

class alert extends Controller
{
    

    public static function show($type,$alert){
        
        Session::flash('alert-msj',$alert);
        Session::flash('alert-type',$type);
    }
}
