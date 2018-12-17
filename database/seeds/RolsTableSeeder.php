<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class RolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rols')->insert([
        	'tipo_rol'=> 1,
            'descripcion'=> "Administrador: Puede agregar y eliminar paquetes, vuelos entre otros servicios",
        ]);

        DB::table('rols')->insert([
        	'tipo_rol'=> 2,
        	'descripcion'=> "Usuario: Utiliza servicios que provee el servicio web",
        ]);
    }
}
