<?php

use Faker\Generator as Faker;

$factory->define(App\Alojamiento::class, function (Faker $faker) {
    $ids_ciudad = \DB::table('ciudads')->select('id')->get();
	$id_ciudad = $ids_ciudad->random()->id;
    return [
        'nombre_alojamiento'=>$faker->departmentName,
        'numero_estrellas'=>$faker->numberBetween(1,5),
        'calle_alojamiento'=>$faker->streetName,
        'numero_alojamiento'=>$faker->buildingNumber,
        'ciudad_id'=>$faker->$id_ciudad,
    ];
});
