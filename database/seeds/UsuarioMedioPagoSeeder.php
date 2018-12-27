<?php

use Illuminate\Database\Seeder;

class UsuarioMedioPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Usuario_MedioDePago::class, 5)->create();
    }
}
