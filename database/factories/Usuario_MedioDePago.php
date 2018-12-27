<?php

use Faker\Generator as Faker;

$factory->define(App\Usuario_MedioDePago::class, function (Faker $faker) {
   
    $ids_user = \DB::table('users')->select('id')->get();
	$id_user = $ids_user->random()->id;

	$ids_medioDePago = \DB::table('medio_de_pagos')->select('id')->get();
	$id_medioDePago = $ids_medioDePago->random()->id;

    return [
        'user_id'=>$id_user,
        'medio_de_pago_id'=>$id_medioDePago,
    ];
});

