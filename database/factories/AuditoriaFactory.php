<?php

use Faker\Generator as Faker;

$factory->define(App\Auditoria::class, function (Faker $faker) {
    return [
      
            'tipo_auditoria' => $faker->numberBetween(1,2);
            'descripcion' => $faker-> realtext(200);

    ];
});
