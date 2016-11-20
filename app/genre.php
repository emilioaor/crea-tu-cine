<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class genre extends Model
{
    protected $table = 'genres';

    protected $fillable = ['name'];

    public function movies(){

    	return $this->belongsToMany('App\movie','movies_genres','id_movie','id_genre');
    }
}
