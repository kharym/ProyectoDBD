<?php

use Faker\Generator as Faker;

$factory->define(App\Empresa::class, function (Faker $faker) {
    
	//Llave foranea
	$ids_ubicacion= \DB::table('ubicacions')->select('id')->get();
	$id_ubicacion= $ids_ubicacion->random()->id;

    return [

    	'nombre_empresa' => $faker->company,
        'telefono_empresa' => $faker->phoneNumber,
        'correo_empresa' => $faker->companyEmail,
        'ubicacion_id' => $id_ubicacion,
    ];
});