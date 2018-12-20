<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    //relacion 1-N con  alojamiento
    public function alojamiento()
    {
      return $this->hasMany('App\Alojamiento');
    }

    //relacion 1-N con  aeropuerto
    public function aeropuerto()
    {
      return $this->hasMany('App\Aeropuerto');
    }

    //relacion 1-N con  empresa
    public function empresa()
    {
      return $this->hasMany('App\Empresa');
    }

    //relacion 1-N con  vueloVa
    public function vueloVa()
    {
      return $this->hasMany('App\Vuelo');
    }

    //relacion 1-N con  vueloViene
    public function vueloViene()
    {
      return $this->hasMany('App\Vuelo');
    }

    //Relacion 1-N con  pais
    public function pais()
    {
        return $this->belongsTo('App\Pais');
    }

    //relacion 1-N con  ubicacion
    public function ubicacion()
    {
      return $this->hasMany('App\Ubicacion');
    }

    protected $fillable = ['nombre_ciudad'];

}
