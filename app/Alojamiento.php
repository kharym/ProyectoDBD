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


    protected $fillable = ['ciudad_id','nombre_alojamiento','numero_estrellas','calle_alojamiento','numero_alojamiento'];
}


            