<?php

use Faker\Generator as Faker;

$factory->define(App\Asiento::class, function (Faker $faker) {

	$ids_vuelo = \DB::table('vuelos')->select('id')->get();
	$id_vuelo = $ids_vuelo->random()->id;

    return [
        'numero_asiento'=>$faker->randomNumber,
        'disponibilidad'=>$faker->boolean,
        'tipo_asiento'=>$faker->numberBetween(0,3),
        'vuelo_id'=>$id_vuelo,

    ];
});