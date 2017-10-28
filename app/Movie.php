<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

use App\Comment;

class Movie extends Model
{
    const STATUS_ACTIVE = 'Activo';
    const DIR_UPLOADS = 'imagesMovies';

    protected $table = 'movies';

    protected $fillable = ['title','synopsis','year','slug','image','genre','trailer','status','cine_id','relation_id'];

    public function getCine() {
        return $this->belongsTo('App\Cinema','cine_id');
    }

    public function getRelationMovie() {
        return $this->belongsTo('App\Relation','relation_id');
    }

    public function getOnlines() {
        return $this->hasMany('App\Online','movie_id');
    }

    public function getDownloads() {
        return $this->hasMany('App\Download','movie_id');
    }

    public function getGenres() {
        return $this->belongsToMany('App\Genre','movies_genres','movie_id','genre_id');
    }

    public function getComments() {
        return $this->hasMany('App\Comment','movie_id');
    }

    public function getLastComments($limit = 10) {
        return Comment::where('movie_id',$this->id)->orderBy('id','DESC')->limit($limit)->get();
    }

    public function getUsersLikes() {
        return $this->belongsToMany('App\User','likes','movie_id','user_id');
    }

    public function isLiked() {
        if (Auth::check()) {
            foreach ($this->getUsersLikes as $like) {
                if (Auth::user()->id == $like->pivot->user_id) {
                    return true;
                }
            }
        }
        return false;
    }
}
