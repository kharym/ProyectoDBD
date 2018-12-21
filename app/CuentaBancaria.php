<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuentaBancaria extends Model
{
    //Relacion 1-N con user

    public function user()
    {
        return $this->belongsTo('App\User');
    }

     protected $fillable = ['usuario_id','saldo','maximo_giro','nombre_banco','fecha_giro','hora_giro'];
}
