<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    //relacion 1-N con  auto
    public function auto()
    {
      return $this->hasMany('App\Auto');
    }

    //Relacion 1-N con  ciudad
    public function ciudad()
    {
        return $this->belongsTo('App\Ciudad');
    }

    protected $fillable = ['ciudad_id','nombre_empresa','telefono_empresa','correo_empresa'];
}