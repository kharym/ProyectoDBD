<?php

use Faker\Generator as Faker;

$factory->define(App\Paquete_ReservaVuelo::class, function (Faker $faker) {

	$ids_paquete = \DB::table('paquetes')->select('id')->get();
	$id_paquete = $ids_paquete->random()->id;

	$ids_reservaVuelo = \DB::table('reserva_vuelos')->select('id')->get();
	$id_reservaVuelo = $ids_reservaVuelo->random()->id;
    
    return [
        'paquete_id'=> $id_paquete,
        'reservaVuelo_id'=>$id_reservaVuelo,
    ];
});

