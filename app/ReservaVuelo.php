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

    //relacion N-N con compra
    public function compra()
    {
        return $this->belongsToMany('App\Compra');
    }

    //relacion N-N con paquete
    public function paquete()
    {
        return $this->belongsToMany('App\Paquete');
    }
}
