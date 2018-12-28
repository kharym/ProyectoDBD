<?php

use Illuminate\Database\Seeder;

class Compra_ReservaVueloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Compra_ReservaVuelo::class, 5)->create();
    }
}
