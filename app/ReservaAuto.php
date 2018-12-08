<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservaAuto extends Model
{
    //relacion 1-1 con compra
    public function compra()
	{
	    return $this->hasOne('App\Compra');
	}

	//relacion 1-1 con paquete
    public function paquete()
	{
	    return $this->hasOne('App\Paquete');
	}
}
