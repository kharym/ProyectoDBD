<?php

use Faker\Generator as Faker;

$factory->define(App\Habitacion::class, function (Faker $faker) {
    
    $ids_reservaHabitacion= \DB::table('reserva_habitacions')->select('id')->get();
	$id_reservaHabitacion= $ids_reservaHabitacion->random()->id;
	$ids_alojamiento = \DB::table('alojamientos')->select('id')->get();
	$id_alojamiento = $ids_alojamiento->random()->id;

    return [
        'numero_habitacion'=>$faker->numberBetween(1,40),
        'tipo_habitacion'=>$faker->numberBetween(0,2),
        'numero_camas'=>$faker->numberBetween(1,4),
        'numero_banos'=>$faker->numberBetween(1,2),
        'disponibilidad'=>$faker->boolean,
        'reserva_habitacion_id'=>$id_reservaHabitacion,
        'alojamiento_id'=>$id_alojamiento,

    ];
});
