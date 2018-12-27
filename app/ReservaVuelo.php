<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservaVuelo extends Model
{
    //Relacion 1-N con  pasajero
    public function pasajero()
    {
        return $this->belongsTo('App\Pasajero');
    }

    //Relacion 1-N con  vuelo
    public function vuelo()
    {
        return $this->belongsTo('App\Vuelo');
    }

    //Relacion 1-1 con  asiento
    public function asiento()
    {
        return $this->belongsTo('App\Asiento');
    }

    //relacion 1-N con compra_ReservaVuelo
    public function compra_reservaVuelo()
    {
      return $this->hasMany('App\Compra_ReservaVuelo');
    }

    //relacion 1-N con paquete_ReservaVuelo
    public function paquete_reservaVuelo()
    {
        return $this->hasMany('App\Paquete_ReservaVuelo');
    }

    protected $fillable = ['vuelo_id','asiento_id','pasajero_id','ida_vuelta','cantidad_pasajeros','tipo_cabina','fecha_reserva','hora_reserva','precio_reserva_vuelo','cantidad_paradas'];
}

