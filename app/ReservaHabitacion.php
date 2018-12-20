<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservaHabitacion extends Model
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

	//relacion 1-N con  habitacion
    public function habitacion()
    {
      return $this->hasMany('App\Habitacion');
    }

    protected $fillable = ['precio_res_hab','fecha_llegada','fecha_ida','numero_ninos','numero_adulto'];
}