<?php

use Faker\Generator as Faker;

$factory->define(App\Rol::class, function (Faker $faker) {
    return [
        	'tipo_rol' => $faker->numberBetween(1,2);
            'descripcion' => $faker-> realtext(200);
    ];
});
