<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    //relacion 1-N con  ciudad
    public function ciudad()
    {
      return $this->hasMany('App\Ciudad');
    }
}
