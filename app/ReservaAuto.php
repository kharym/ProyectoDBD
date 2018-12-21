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

	//Relacion 1-1 con auto
    public function auto()
    {
        return $this->belongsTo('App\Auto');
    }

    protected $fillable = ['auto_id','precio_auto','fecha_recogido','fecha_devolucion','hora_recogido','hora_devolucion','tipo_auto'];
}