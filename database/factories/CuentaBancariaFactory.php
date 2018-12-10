<?php

use Faker\Generator as Faker;

$factory->define(App\CuentaBancaria::class, function (Faker $faker) {
   
   //Llave foranea
	$ids_user= \DB::table('users')->select('id')->get();
	$id_user= $ids_user->random()->id;
    return [
    	'saldo' => $faker->randomFloat,
    	'maximo_giro' => $faker->randomFloat,
        'nombre_banco' => $faker->bank, //Cambiar a bank
        'fecha_giro' => $faker->date('Y-m-d', '2018-12-14'),
        'hora_giro' => $faker->time('H:i:s', '12:50:32'),
        'usuario_id' => $id_user,
    ];
});