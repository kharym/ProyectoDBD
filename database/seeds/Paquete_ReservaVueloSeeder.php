<?php

use Illuminate\Database\Seeder;

class Paquete_ReservaVueloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Paquete_ReservaVuelo::class, 5)->create();
    }
}
