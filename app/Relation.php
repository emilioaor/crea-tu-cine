<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    protected $table = 'relations';

    protected $fillable = ['name','cine_id'];

    public function getMovies() {
        return $this->hasMany('App\Movie','relation_id');
    }

    public function getCine() {
        return $this->belongsTo('App\Cinema','cine_id');
    }
}
