<?php

use Illuminate\Database\Seeder;

class ReservasAutoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ReservaAuto::class, 5)->create();
    }
}
