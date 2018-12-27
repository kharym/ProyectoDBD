<?php

use Faker\Generator as Faker;

$factory->define(App\Compra_ReservaVuelo::class, function (Faker $faker) {
    
    $ids_compra = \DB::table('compras')->select('id')->get();
	$id_compra = $ids_compra->random()->id;

	$ids_reservaVuelo = \DB::table('reserva_vuelos')->select('id')->get();
	$id_reservaVuelo = $ids_reservaVuelo->random()->id;

    return [
        'compra_id'=>$id_compra,
        'reserva_vuelo_id'=>$id_reservaVuelo,
    ];
});
