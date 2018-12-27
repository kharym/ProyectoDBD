<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paquete extends Model
{
 	 
	//relacion 1-N con  compra
    public function compra()
    {
      return $this->hasMany('App\Compra');
    }

    //Relacion 1-1 con  reservaHabitacion
    public function reservaHabitacion()
    {
        return $this->belongsTo('App\ReservaHabitacion');
    }

    //Relacion 1-1 con  reservaAuto
    public function reservaAuto()
    {
        return $this->belongsTo('App\ReservaAuto');
    }

    //relacion 1-N con paquete_reservaVuelo
    public function paquete_reservaVuelo()
    {
        return $this->hasMany('App\Paquete_ReservaVuelo');
    }

    protected $fillable = ['reserva_auto_id','reserva_habitacion_id','precio','descuento','tipo_paquete','disponibilidad'];

}