<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *///select test_table.name into name from test_table where id = x;
    public function up()
    {
        DB::statement('
            CREATE OR REPLACE FUNCTION llenarAsientos()
            RETURNS trigger AS
            $$
                DECLARE
                i INTEGER := NEW.cantidad_asientos;
                j INTEGER := 0;
                valor INTEGER := NEW.id;
                BEGIN           
                LOOP 
                    EXIT WHEN j = i;
                    j := j + 1;
                    INSERT INTO asientos( vuelo_id, numero_asiento, disponibilidad,tipo_asiento,created_at) VALUES 
                    (valor, j, true, 1, NEW.created_at );
                END LOOP ;
                RETURN NEW;
            END
            $$ LANGUAGE plpgsql;
        ');
        DB::unprepared('
        CREATE TRIGGER asiento_Vuelo AFTER INSERT ON vuelos FOR EACH ROW
        EXECUTE PROCEDURE llenarAsientos();
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trigger');
    }
}
