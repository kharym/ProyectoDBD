<?php

use Faker\Generator as Faker;

$factory->define(App\Paquete::class, function (Faker $faker) {
	$ids_reservaAuto = \DB::table('autos')->select('id')->get();
	$id_reservaAuto = $ids_reservaAuto->random()->id;

	$ids_reservaHabitacion = \DB::table('habitacions')->select('id')->get();
	$id_reservaHabitacion = $ids_reservaHabitacion->random()->id;


	$ids_vuelo = \DB::table('vuelos')->select('id')->get();
	$id_vuelo = $ids_vuelo->random()->id;

    return [
        'precio'=>$faker->randomFloat,
        'descuento'=>$faker->randomFloat,
        'pasajeros'=>$faker->numberBetween(1,3),
        'tipo_paquete'=>$faker->numberBetween(1,4),
        'disponibilidad'=>$faker->boolean,
        'auto_id' => $id_reservaAuto,
        'habitacion_id' => $id_reservaHabitacion,
        'vuelo_id' => $id_vuelo, 
    ];
});