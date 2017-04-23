<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    const STATUS_ACTIVE = 'Activo';

    protected $table = 'comments';

    protected $fillable = ['content','email','status','movie_id','user_id'];

    public function getMovie() {
        return $this->belongsTo('App\Movie','movie_id');
    }

    public function getUser() {
        return $this->belongsTo('App\User','user_id');
    }

}
