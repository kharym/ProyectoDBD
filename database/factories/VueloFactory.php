<?php

use Faker\Generator as Faker;

$factory->define(App\Vuelo::class, function (Faker $faker) {
	$ids_ciudad = \DB::table('ciudads')->select('id')->get();
	$id_ciudadOrigen = $ids_ciudad->random()->id;
	$id_ciudadDestino = $ids_ciudad->random()->id;


    return [
        'origen'=>$faker->city,
        'destino'=>$faker->city,
        'precio_vuelo'=>$faker->randomFloat,
        'cantidad_asientos'=>$faker->randomDigitNotNull,
        'fecha_ida'=>$faker->date('Y-m-d', '2018-12-14'),
        'fecha_llegada'=>$faker->date('Y-m-d', '2018-12-15'),
        'hora_ida'=>$faker->time('H:i:s', '12:50:32'),
        'hora_llegada'=>$faker->time('H:i:s', '12:51:32'),
        'duracion_viaje'=>$faker->time('H:i:s', '1:01:00'),
        'ciudad_viene_id'=>$id_ciudadOrigen,
        'ciudad_va_id'=>$id_ciudadDestino,


    ];
});
