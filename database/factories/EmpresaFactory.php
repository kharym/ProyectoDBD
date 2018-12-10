<?php

use Faker\Generator as Faker;

$factory->define(App\Empresa::class, function (Faker $faker) {
    
	//Llave foranea
	$ids_ciudad= \DB::table('ciudads')->select('id')->get();
	$id_ciudad= $ids_ciudad->random()->id;

    return [

    	'nombre_empresa' => $faker->company,
        'telefono_empresa' => $faker->phoneNumber,
        'correo_empresa' => $faker->companyEmail,
        'ciudad_id' => $id_ciudad,
    ];
});