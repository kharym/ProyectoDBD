<?php

use Faker\Generator as Faker;

$factory->define(App\Paquete::class, function (Faker $faker) {
	$ids_reservaAuto = \DB::table('reserva_autos')->select('id')->get();
	$id_reservaAuto = $ids_reservaAuto->random()->id;

	$ids_reservaHabitacion = \DB::table('reserva_habitacions')->select('id')->get();
	$id_reservaHabitacion = $ids_reservaHabitacion->random()->id;

    return [
        'precio'=>$faker->randomFloat,
        'descuento'=>$faker->randomFloat,
        'tipo_paquete'=>$faker->numberBetween(1,4),
        'disponibilidad'=>$faker->boolean,

    ];
});