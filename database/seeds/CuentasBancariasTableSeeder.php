<?php

use Illuminate\Database\Seeder;

class CuentasBancariasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\CuentaBancaria::class, 5)->create();
    }
}
