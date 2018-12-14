<?php

use Faker\Generator as Faker;
$autoIncrement = autoIncrement();

$factory->define(App\Asiento::class, function (Faker $faker)  use ($autoIncrement) {
    $autoIncrement->next();
	$ids_vuelo = \DB::table('vuelos')->select('id')->get();
	$id_vuelo = $ids_vuelo->random()->id;

    return [
        'disponibilidad'=>$faker->boolean,
        'tipo_asiento'=>$faker->numberBetween(0,3),
        'vuelo_id'=>$id_vuelo,
        'numero_asiento'=>$autoIncrement->current(),
    ];
});


function autoIncrement()
{
    for ($i = 0; $i < 50; $i++) {
        yield $i;
    }   
}