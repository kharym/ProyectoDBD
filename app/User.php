<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Relacion 1-1 con auditoria
    public function auditoria()
    {
        return $this->belongsTo('App\Auditoria');
    }

    //Relacion 1-N con rol
    public function rol()
    {
        return $this->belongsTo('App\Rol');
    }

    //relacion 1-N con cuentaBancaria
    public function cuentaBancaria()
    {
      return $this->hasMany('App\CuentaBancaria');
    }

    //relacion 1-N con compra
    public function compra()
    {
      return $this->hasMany('App\Compra');
    }

    //relacion 1-N con medioDePago
    public function usuario_medioDePago()
    {
        return $this->hasMany('App\Usuario_MedioDePago');
    }

     protected $fillable = ['rol_id','auditoria_id','name','apellido','email','tipo_documento','numero_documento','pais','fecha_nacimiento','telefono','password'];
}