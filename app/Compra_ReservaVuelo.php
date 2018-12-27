<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra_ReservaVuelo extends Model
{
     //Relacion 1-N con compra
    public function compra()
    {
        return $this->belongsTo('App\Compra');
    }

    //Relacion 1-N con reservaVuelo
    public function reservaVuelo()
    {
        return $this->belongsTo('App\ReservaVuelo');
    }

    protected $fillable = ['compra_id','reserva_vuelo_id'];
}
