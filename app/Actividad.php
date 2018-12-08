<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    //relacion 1-N con  compra
    public function compra()
    {
      return $this->hasMany('App\Compra');
    }
}
