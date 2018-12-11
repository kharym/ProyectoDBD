<?php

use Illuminate\Database\Seeder;

class AlojamientosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Alojamiento::class, 5)->create();
    }
}
