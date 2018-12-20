<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
	//relacion 1-N con usuario
    public function user()
	{
	  return $this->hasMany('App\User');
	}


	protected $fillable = ['tipo_rol','descripcion'];
}
