<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $fillable = ['destino','nombre_actividad','precio','cantidad_adulto','cantidad_ninos',
    'fecha_ida','fecha_vuelta'];
    //relacion 1-N con  compra
    public function compra()
    {
      return $this->hasMany('App\Compra');
    }
}
