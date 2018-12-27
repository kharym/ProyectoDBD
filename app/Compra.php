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

     //relacion 1-N con compra_reservaVuelo
    public function compra_reservaVuelo()
    {
      return $this->hasMany('App\Compra_ReservaVuelo');
    }


    protected $fillable = ['usuario_id','actividad_id','seguro_id','paquete_id','reserva_auto_id','reserva_habitacion_id','fecha_compra','hora_compra'];
    
}
