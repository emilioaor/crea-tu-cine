<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Online extends Model
{
    const STATUS_ACTIVE = 'Activo';

    protected $table = 'onlines';

    protected $fillable = ['title_url','url','status','movie_id'];

    public function getMovie() {
        return $this->belongsTo('App\Movie','movie_id');
    }
}
