<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    protected $table = 'styles';

    protected $fillable = ['selector','property','value','cine_id'];

    public function getCine() {
        return $this->belongsTo('App\Cinema', 'cine_id');
    }
}
