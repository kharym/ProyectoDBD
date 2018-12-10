<?php

use Faker\Generator as Faker;

$factory->define(App\Actividad::class, function (Faker $faker) {
    	
    return [
       
        'destino' => $faker-> realtext(40),
        'nombre_actividad' => $faker-> realtext(100),
        'precio' => $faker->randomFloat,
        'cantidad_adulto' => $faker->randomDigitNotNull,
        'cantidad_ninos' => $faker->randomDigitNotNull,
        'fecha_ida' => $faker->date('Y-m-d', '2018-12-14'),
        'fecha_vuelta' => $faker->date('Y-m-d', '2018-12-14'),
    ];
});
            