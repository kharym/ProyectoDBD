<?php

use Illuminate\Database\Seeder;

class MediosDePagoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\MedioDePago::class, 5)->create();
    }
}
