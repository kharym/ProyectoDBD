<?php

use Illuminate\Database\Seeder;

class PaquetesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Paquete::class, 5)->create();
    }
}
