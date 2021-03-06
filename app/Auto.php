<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    //relacion 1-1 con reservaAuto
    public function reservaAuto()
	{
	    return $this->hasOne('App\ReservaAuto');
	}

	//Relacion 1-N con  empresa
    public function empresa()
    {
        return $this->belongsTo('App\Empresa');
    }

    protected $fillable = ['empresa_id','numero_puertas','tipo_transmision','numero_asientos','modelo','marca','disponibilidad','precio'];
}
