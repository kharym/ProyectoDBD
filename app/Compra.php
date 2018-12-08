<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    //Relacion 1-N con user
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //Relacion 1-N con seguro
    public function seguro()
    {
        return $this->belongsTo('App\Seguro');
    }

    //Relacion 1-N con actividad
    public function actividad()
    {
        return $this->belongsTo('App\Actividad');
    }
    
    //Relacion 1-1 con reservaAuto
    public function reservaAuto()
    {
        return $this->belongsTo('App\ReservaAuto');
    }

    //Relacion 1-1 con reservaHabitacion
    public function reservaHabitacion()
    {
        return $this->belongsTo('App\ReservaHabitacion');
    }

    //Relacion 1-N con paquete
    public function paquete()
    {
        return $this->belongsTo('App\Paquete');
    }

     //relacion N-N con reservaVuelo
    public function reservaVuelo()
    {
        return $this->belongsToMany('App\ReservaVuelo');
    }


    
}
