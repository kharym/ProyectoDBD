<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    //Relacion 1-N con  ciudad
    public function ciudad()
    {
        return $this->belongsTo('App\Ciudad');
    }
}
