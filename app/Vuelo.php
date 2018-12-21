<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vuelo extends Model
{
    //relacion 1-N con  reservaVuelo
    public function reservaVuelo()
    {
      return $this->hasMany('App\ReservaVuelo');
    }

    //relacion 1-N con  asiento
    public function asiento()
    {
      return $this->hasMany('App\Asiento');
    }

    //Relacion 1-N con  ciudadVa
    public function ciudadVa()
    {
        return $this->belongsTo('App\Ciudad');
    }

    //Relacion 1-N con  ciudadViene
    public function ciudadViene()
    {
        return $this->belongsTo('App\Ciudad');
    }

    protected $fillable = ['ciudad_va_id','ciudad_viene_id','origen','destino','precio_vuelo','cantidad_asientos','fecha_ida','hora_ida','fecha_llegada','hora_llegada','duracion_viaje'];
}