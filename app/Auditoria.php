<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{

	//relacion 1-1 con usuario
    public function user()
	{
	    return $this->hasOne('App\User');
	}
}
