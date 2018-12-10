<?php

use Illuminate\Database\Seeder;

class AuditoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Auditoria::class, 5)->create();
    }
}
