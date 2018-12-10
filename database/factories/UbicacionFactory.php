<?php

use Faker\Generator as Faker;

$factory->define(App\Ubicacion::class, function (Faker $faker) {
    
	//Llave foranea
	$ids_ciudad= \DB::table('ciudad')->select('id')->get();
	$id_ciudad= $ids_ciudad->random()->id;

    return [

    	'latitud'=> $faker->latitude,
    	'longitd'=>$faker->longitude,
    	'codigo_postal' => $faker->randomNumber,
    	'ciudad_id' => $id_ciudad,
        
    ];
});
