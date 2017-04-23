<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genres';

    protected $fillable = ['name'];

    public function getMovies() {
        return $this->belongsToMany('App\Movies','movies_genres','movie_id','genre_id');
    }
}
