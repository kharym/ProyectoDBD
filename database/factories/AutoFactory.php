<?php

use Faker\Generator as Faker;

$factory->define(App\Auto::class, function (Faker $faker) {
    $ids_empresa = \DB::table('empresas')->select('id')->get();
    $id_empresa = $ids_empresa->random()->id;
    $faker = (new \Faker\Factory())::create();
    $faker->addProvider(new \Faker\Provider\Fakecar($faker));
    

    return [
        'numero_puertas' => $faker->randomDigit(2,4),
        'tipo_transmision' => $faker->numberBetween(0,1),
        'numero_asientos' =>$faker->numberBetween(2,4),
        'modelo' =>$faker->vehicleModel,
        'marca' =>$faker->vehicleBrand,
        'disponibilidad' =>$faker->boolean,
        'empresa_id' =>$id_empresa,
        'precio' =>$faker->randomFloat,
    ];
});
