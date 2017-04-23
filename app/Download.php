<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    const STATUS_ACTIVE = 'Activo';

    protected $table = 'downloads';

    protected $fillable = ['title','url','status','movie_id'];

    public function getMovie() {
        return $this->belongsTo('App\Movie','movie_id');
    }
}
