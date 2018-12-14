<?php

use Faker\Generator as Faker;

$factory->define(App\ReservaVuelo::class, function (Faker $faker) {

	$ids_vuelo = \DB::table('vuelos')->select('id')->get();
	$id_vuelo = $ids_vuelo->random()->id;

	$ids_asiento = \DB::table('asientos')->select('id')->get();
	$id_asiento = $ids_asiento->random()->id;

	$ids_pasajero = \DB::table('pasajeros')->select('id')->get();
	$id_pasajero = $ids_pasajero->random()->id;



    return [
        'ida_vuelta'=>$faker->boolean,
        'cantidad_pasajeros'=>$faker->randomDigitNotNull,
        'tipo_cabina'=>$faker->numberBetween(0,2),
        'fecha_reserva'=>$faker->date('Y-m-d', '2018-12-14'),
        'hora_reserva'=>$faker->time('H:i:s', '12:50:32'),
        'precio_reserva_vuelo'=>$faker->randomFloat,
        'cantidad_paradas'=>$faker->numberBetween(1,3),
        'vuelo_id'=>$id_vuelo,
        'asiento_id'=>$id_asiento,
        'pasajero_id'=>$id_pasajero,


    ];
});