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
        $this->call(EmpresasTableSeeder::class);
        $this->call(AutosTableSeeder::class);
        $this->call(MediosDePagoTableSeeder::class);
        $this->call(PasajerosTableSeeder::class);
        $this->call(ReservasAutoTableSeeder::class);
        $this->call(AlojamientosTableSeeder::class);
        $this->call(ReservasHabitacionTableSeeder::class);
        $this->call(HabitacionesTableSeeder::class);
        $this->call(VuelosTableSeeder::class);
        $this->call(SegurosTableSeeder::class);
        $this->call(AeropuertosTableSeeder::class);
        //$this->call(AsientosTableSeeder::class);
        $this->call(ReservasVueloTableSeeder::class);
        $this->call(PaquetesTableSeeder::class);
        $this->call(ComprasTableSeeder::class);
        $this->call(UbicacionesTableSeeder::class);
        $this->call(Paquete_ReservaVueloSeeder::class);
        $this->call(UsuarioMedioPagoSeeder::class);
        $this->call(Compra_ReservaVueloSeeder::class);
    }
}
