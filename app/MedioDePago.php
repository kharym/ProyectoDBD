<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedioDePago extends Model
{
    //relacion 1-N con usuario_MedioDePAgo
    public function user()
    {
        return $this->hasMany('App\Usuario_MedioDePAgo');
    }


     protected $fillable = ['tipo_medioPago','disponibilidad','monto'];
}