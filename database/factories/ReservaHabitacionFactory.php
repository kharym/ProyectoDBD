<?php

use Faker\Generator as Faker;

$factory->define(App\ReservaHabitacion::class, function (Faker $faker) {
    return [
        'precio_res_hab' => $faker->randomFloat,
        'fecha_llegada' => $faker->date('Y-m-d', '2018-12-14'),
        'fecha_ida' => $faker->date('Y-m-d', '2018-12-14'),
        'numero_ninos' => $faker->randomDigitNotNull,
        'numero_adulto' => $faker->randomDigitNotNull,
        
    ];
});