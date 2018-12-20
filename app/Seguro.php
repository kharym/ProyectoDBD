<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seguro extends Model
{
    
    //relacion 1-N con  compra
    public function compra()
    {
      return $this->hasMany('App\Compra');
    }

    protected $fillable = ['edad_pasajero','ida_vuelta','cantidad_personas','fecha_ida','fecha_vuelta','destino','costo_pasaje'];
}