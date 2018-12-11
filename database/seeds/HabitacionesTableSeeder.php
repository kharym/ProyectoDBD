<?php

use Illuminate\Database\Seeder;

class HabitacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Habitacion::class, 5)->create();
    }
}
