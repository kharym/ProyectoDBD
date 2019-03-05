<?php

use Faker\Generator as Faker;

$factory->define(App\Actividad::class, function (Faker $faker) {
    $ids_ciudad = \DB::table('ciudads')->select('id')->get();
	$id_ciudad = $ids_ciudad->random()->id;	
    return [
       
        'ciudad_id' => $id_ciudad,
        'nombre_actividad' => $faker-> realtext(100),
        'precio' => $faker->randomFloat,

    ];
});
            