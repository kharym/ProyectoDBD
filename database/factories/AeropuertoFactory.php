<?php

use Faker\Generator as Faker;

$factory->define(App\Aeropuerto::class, function (Faker $faker) {

	$ids_ciudad = \DB::table('ciudads')->select('id')->get();
	$id_ciudad = $ids_ciudad->random()->id;

    return [
        'nombre_aeropuerto'=>$faker->realtext(100),
        'calle_aeropuerto'=>$faker->streetName,
        'numero_aeropuerto'=>$faker->buildingNumber,
        'ciudad_id'=>$id_ciudad,
    ];
});