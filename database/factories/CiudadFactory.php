<?php

use Faker\Generator as Faker;

$factory->define(App\Ciudad::class, function (Faker $faker) {
   
   //Llave foranea
	$ids_pais= \DB::table('pais')->select('id')->get();
	$id_pais= $ids_pais->random()->id;

    return [
        'nombre_ciudad'=> $faker->city,
        'pais_id' => $id_pais,
    ];
});