<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alojamiento extends Model
{
    //relacion 1-N con  habitacion
    public function habitacion()
    {
      return $this->hasMany('App\Habitacion');
    }

    //Relacion 1-N con  ciudad
    public function ciudad()
    {
        return $this->belongsTo('App\Ciudad');
    }
}
