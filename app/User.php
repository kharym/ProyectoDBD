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
    protected $fillable = [
        'name', 'email', 'password',
    ];

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

    //relacion N-N con medioDePago
    public function medioDePago()
    {
        return $this->belongsToMany('App\MedioDePago');
    }
}
