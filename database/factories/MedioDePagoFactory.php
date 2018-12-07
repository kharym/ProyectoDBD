<?php

use Faker\Generator as Faker;

$factory->define(App\MedioDePago::class, function (Faker $faker) {
    return [
    	'tipo_medioPago' => $faker->randomDigitNotNull,
        'disponibilidad' => $faker-> boolean,
        'monto' => $faker->randomFloat,
    ];
});