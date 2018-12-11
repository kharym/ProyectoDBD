<?php

use Illuminate\Database\Seeder;

class ReservasHabitacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ReservaHabitacion::class, 5)->create();
    }
}
