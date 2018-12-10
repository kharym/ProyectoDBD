<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolsTableSeeder::class);
        $this->call(AuditoriasTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ActividadesTableSeeder::class);
        $this->call(PaisesTableSeeder::class);
        $this->call(CiudadesTableSeeder::class);
        $this->call(CuentasBancariasTableSeeder::class);
    }
}
