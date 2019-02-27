<?php

use Faker\Generator as Faker;

$factory->define(App\Habitacion::class, function (Faker $faker) {
    

	$ids_alojamiento = \DB::table('alojamientos')->select('id')->get();
	$id_alojamiento = $ids_alojamiento->random()->id;

    return [
        'numero_habitacion'=>$faker->numberBetween(1,40),
        'tipo_habitacion'=>$faker->numberBetween(0,2),
        'numero_camas'=>$faker->numberBetween(1,4),
        'numero_banos'=>$faker->numberBetween(1,2),
        'capacidad_ninos'=>$faker->numberBetween(1,5),
        'capacidad_adultos'=>$faker->numberBetween(1,5),
        'disponibilidad'=>$faker->boolean,
        'alojamiento_id'=>$id_alojamiento,
        'precio'=>$faker->randomFloat,

    ];
});
