<?php

use Illuminate\Database\Seeder;

class AutosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Auto::class, 5)->create();
    }
}
