<?php

use Illuminate\Database\Seeder;

class ReservasVueloTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ReservaVuelo::class, 5)->create();
    }
}
