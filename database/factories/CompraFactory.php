<?php

use Faker\Generator as Faker;

$factory->define(App\Compra::class, function (Faker $faker) {
	$ids_user = \DB::table('users')->select('id')->get();
	$id_user = $ids_user->random()->id;

	$ids_actividad = \DB::table('actividads')->select('id')->get();
	$id_actividad = $ids_actividad->random()->id;

	$ids_seguro = \DB::table('seguros')->select('id')->get();
	$id_seguro = $ids_seguro->random()->id;

	$ids_paquete = \DB::table('paquetes')->select('id')->get();
	$id_paquete = $ids_paquete->random()->id;

	$ids_reservaAuto = \DB::table('reserva_autos')->select('id')->get();
	$id_reservaAuto = $ids_reservaAuto->random()->id;

	$ids_reservaHabitacion = \DB::table('reserva_habitacions')->select('id')->get();
	$id_reservaHabitacion = $ids_reservaHabitacion->random()->id;


    return [
        'fecha_compra'=>$faker->date('Y-m-d', '2018-12-14'),
        'hora_compra'=>$faker->time('H:i:s', '12:50:32'),
        'user_id'=>$id_user,
        'actividad_id'=>$id_actividad,
        'seguro_id'=>$id_seguro,
        'paquete_id'=>$id_paquete,
        'reserva_auto_id'=>$id_reservaAuto,
        'reserva_habitacion_id'=>$id_reservaHabitacion,



    ];
});
