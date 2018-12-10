<?php

use Faker\Generator as Faker;

$factory->define(App\Seguro::class, function (Faker $faker) {
    return [
    	'edad_pasajero' => $faker->numberBetween(1,110),
    	'ida_vuelta' => $faker-> boolean,
   	 	'cantidad_personas' => $faker->randomDigitNotNull,
   	 	'fecha_ida' => $faker->date('Y-m-d', '2018-12-14'),
        'fecha_vuelta' => $faker->date('Y-m-d', '2018-12-14'),
        'destino' => $faker-> realtext(40),
        'costo_pasaje' => $faker->randomFloat,
        
    ];
});
