<?php

use Illuminate\Database\Seeder;

class SegurosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Seguro::class, 5)->create();
    }
}
