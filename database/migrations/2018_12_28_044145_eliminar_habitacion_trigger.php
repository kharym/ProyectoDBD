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
        CREATE OR REPLACE FUNCTION eliminarAsientos()
        RETURNS trigger AS
        $$
        BEGIN           
        DELETE FROM asientos
        WHERE OLD.id = asientos.vuelo_id;
        RETURN OLD;
        END
        $$ LANGUAGE plpgsql;
        ');

        DB::unprepared('
        CREATE TRIGGER usuario_rol BEFORE DELETE ON vuelos FOR EACH ROW
        EXECUTE PROCEDURE eliminarAsientos();
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
