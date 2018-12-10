<?php

use Faker\Generator as Faker;

$factory->define(App\Auto::class, function (Faker $faker) {
    $ids_empresa = \DB::table('empresa')->select('id')->get();
	$id_empresa = $ids_empresa->random()->id;
    return [
        'numero_puertas' => $faker->numberBetween(2,4),
        'tipo_transmision' => $faker->numberBetween(0,1),
        'numero_asientos' =>$faker->numberBetween(2,4),
        'modelo' =>$faker->realtext(50),
        'marca' =>$faker->realtext(30),
        'disponibilidad' =>$faker->boolean,
        'empresa_id' =>$faker->$id_empresa,
    ];
});
