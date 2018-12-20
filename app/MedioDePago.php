<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedioDePago extends Model
{
    //relacion N-N con user
    public function user()
    {
        return $this->belongsToMany('App\User');
    }


     protected $fillable = ['tipo_medioPago','disponibilidad','monto'];
}