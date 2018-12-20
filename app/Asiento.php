<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asiento extends Model
{
    //relacion 1-1 con reservaVuelo
    public function reservaVuelo()
	{
	    return $this->hasOne('App\ReservaVuelo');
	}

	//Relacion 1-N con  vuelo
    public function vuelo()
    {
        return $this->belongsTo('App\Vuelo');
    }

    protected $fillable = ['numero_asiento','disponibilidad','tipo_asiento'];
}