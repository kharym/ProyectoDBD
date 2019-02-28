<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    //Relacion 1-N con  ciudad
    public function ciudad()
    {
        return $this->belongsTo('App\Ciudad');
    }

    //relacion 1-N con  empresa
    public function empresa()
    {
      return $this->hasMany('App\Empresa');
    }

    protected $fillable = ['ciudad_id','latitud','longitud','codigo_postal','calle','numero'];
}