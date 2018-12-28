<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EliminarHabitacionTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
        CREATE OR REPLACE FUNCTION eliminarHabitacion()
        RETURNS trigger AS
        $$
        BEGIN           
        DELETE FROM habitacions
        WHERE OLD.id = habitacions.alojamiento_id;
        RETURN OLD;
        END
        $$ LANGUAGE plpgsql;
        ');

        DB::unprepared('
        CREATE TRIGGER eliminarHabitacion BEFORE DELETE ON alojamientos FOR EACH ROW
        EXECUTE PROCEDURE eliminarHabitacion();
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eliminar_habitacion_trigger');
    }
}
