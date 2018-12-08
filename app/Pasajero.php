<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasajero extends Model
{
    //relacion 1-N con  reservaVuelo
    public function reservaVuelo()
    {
      return $this->hasMany('App\ReservaVuelo');
    }
}
