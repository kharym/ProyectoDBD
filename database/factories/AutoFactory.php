<?php

use Faker\Generator as Faker;

$factory->define(App\Auto::class, function (Faker $faker) {
    $ids_empresa = \DB::table('empresas')->select('id')->get();
	$id_empresa = $ids_empresa->random()->id;
    return [
        'numero_puertas' => $faker->randomDigit(2,4),
        'tipo_transmision' => $faker->numberBetween(0,1),
        'numero_asientos' =>$faker->numberBetween(2,4),
        'modelo' =>$faker->realtext(50),
        'marca' =>$faker->realtext(30),
        'disponibilidad' =>$faker->boolean,
        'empresa_id' =>$id_empresa,
    ];
});
