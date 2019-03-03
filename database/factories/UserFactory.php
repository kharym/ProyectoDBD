<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {

	$ids_user = \DB::table('rols')->select('id')->get();
	$id_user = $ids_user->random()->id;


    return [
        'name' => $faker->firstname,
        'apellido' => $faker->lastname,
        'email' => $faker->unique()->safeEmail,
        'tipo_documento' => $faker->numberBetween(1,2),
        'numero_documento' => $faker->randomNumber,
        'pais' => $faker->country,
        'fecha_nacimiento' => $faker->date,
        'telefono' => $faker->e164phoneNumber,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'rol_id' => $id_user,
    ];
});
