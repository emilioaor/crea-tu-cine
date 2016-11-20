<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class movie extends Model
{
    protected $table = 'movies';

    protected $fillable = ['title','synopsis','image','download','year','slug','trailer','online','uploaded','turbobit','thevideos','thevideos2','completa','id_relation'];

    public function relation(){

    	return $this->belongsTo('App\relation','id_relation');
    }

    public function genres(){

    	return $this->belongsToMany('App\genre','movies_genres','id_movie','id_genre');
    }

    public function scopeSearch($query, $title){

    	return $query->where('title','like',"%$title%");
    }
}
