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
}
