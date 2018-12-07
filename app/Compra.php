<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    //Relacion 1-N con user
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
