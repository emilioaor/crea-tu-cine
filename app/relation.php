<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class relation extends Model
{
    protected $table = 'relations';

    protected $fillable = ['name'];

    public function movies(){

    	return $this->hasMany('App\movie','id_relation');
    }
}
