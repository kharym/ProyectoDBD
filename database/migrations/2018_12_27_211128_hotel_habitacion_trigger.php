<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HotelHabitacionTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
        CREATE OR REPLACE FUNCTION deshabilitarHabitacion()
        RETURNS trigger AS
        $$
        BEGIN           
        IF  NEW.disponibilidad = false THEN
                UPDATE habitacions
                SET disponibilidad = false
                WHERE habitacions.alojamiento_id = NEW.id;
        ELSEIF NEW.disponibilidad = true THEN
            UPDATE habitacions
            SET disponibilidad = true
            WHERE habitacions.alojamiento_id = NEW.id;
        END IF;
        RETURN NEW;
        END
        $$ LANGUAGE plpgsql;
        ');

        DB::unprepared('
        CREATE TRIGGER usuario_rol AFTER UPDATE ON alojamientos FOR EACH ROW
        EXECUTE PROCEDURE deshabilitarHabitacion();
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel_habitacion_trigger');
    }
}
