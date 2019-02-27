<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    //Relacion 1-N con reservaHabitacion
    public function reservaHabitacion()
    {
        return $this->belongsTo('App\ReservaHabitacion');
    }

    //Relacion 1-N con alojamiento
    public function alojamiento()
    {
        return $this->belongsTo('App\Alojamiento');
    }

    protected $fillable = ['reserva_habitacion_id','alojamiento_id','numero_habitacion','tipo_habitacion','numero_camas','numero_banos','disponibilidad','capacidad'];
}