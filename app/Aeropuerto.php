<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aeropuerto extends Model
{
    //Relacion 1-N con  ciudad
    public function ciudad()
    {
        return $this->belongsTo('App\Ciudad');
    }

    protected $fillable = ['nombre_aeropuerto','calle_aeropuerto','numero_aeropuerto'];
}
