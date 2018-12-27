<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario_MedioDePago extends Model
{
    //Relacion 1-N con usuario
    public function usuario()
    {
        return $this->belongsTo('App\User');
    }

    //Relacion 1-N con medioDePago
    public function medioDePago()
    {
        return $this->belongsTo('App\MedioDePago');
    }

    protected $fillable = ['usuario_id','medio_de_pago_id'];
}
