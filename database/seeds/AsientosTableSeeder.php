<?php

use Illuminate\Database\Seeder;

class AsientosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Asiento::class, 5)->create();
    }
}
