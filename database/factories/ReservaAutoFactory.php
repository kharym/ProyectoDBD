<?php

use Faker\Generator as Faker;

$factory->define(App\ReservaAuto::class, function (Faker $faker) {
    $ids_auto = \DB::table('autos')->select('id')->get();
	$id_auto = $ids_auto->random()->id;
    return [
    	'precio_auto' => $faker->randomFloat,
    	'fecha_recogido'=>$faker->date('Y-m-d', '2018-12-14'),
    	'fecha_devolucion'=>$faker->date('Y-m-d', '2018-12-14'),
    	'hora_recogido'=>$faker->time('H:i:s', '12:50:32'),
    	'hora_devolucion'=>$faker->time('H:i:s', '12:50:33'),
    	'tipo_auto'=>$faker->numberBetween(0,2),
    	'auto_id' => $id_auto,
        
    ];
});