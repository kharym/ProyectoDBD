<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    //relacion 1-N con  alojamiento
    public function alojamiento()
    {
      return $this->hasMany('App\Alojamiento');
    }

    //relacion 1-N con  aeropuerto
    public function aeropuerto()
    {
      return $this->hasMany('App\Aeropuerto');
    }

    //relacion 1-N con  empresa
    public function empresa()
    {
      return $this->hasMany('App\Empresa');
    }
}
