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

    protected $fillable = ['name','apellido','dni_pasaporte','pais','menor_edad','telefono','asistencia_especial','movilidad_reducida'];
}
