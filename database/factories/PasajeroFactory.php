<?php

use Faker\Generator as Faker;

$factory->define(App\Pasajero::class, function (Faker $faker) {
    return [
        'name' => $faker->firstname,
        'apellido' => $faker->lastname,
        'dni_pasaporte' => $faker-> realtext(15),
        'pais' => $faker->country,
        'menor_edad' => $faker-> boolean,
        'telefono' => $faker->phoneNumber,
        'asistencia_especial' => $faker-> boolean,
        'movilidad_reducida' => $faker-> boolean,
    ];
});