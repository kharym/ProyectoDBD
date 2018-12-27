<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paquete_ReservaVuelo extends Model
{
    //Relacion 1-N con paquete
    public function paquete()
    {
        return $this->belongsTo('App\Paquete');
    }

    //Relacion 1-N con reservaVuelo
    public function reservaVuelo()
    {
        return $this->belongsTo('App\ReservaVuelo');
    }

    protected $fillable = ['paquete_id','reserva_vuelo_id'];
}
