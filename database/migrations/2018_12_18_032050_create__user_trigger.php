<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
        CREATE OR REPLACE FUNCTION asignarRol()
        RETURNS trigger AS
        $$
        BEGIN           
            UPDATE users
            SET rol_id = 1
            WHERE users.id = NEW.id;
            RETURN NEW;
        END
        $$ LANGUAGE plpgsql;
        ');

        DB::unprepared('
        CREATE TRIGGER usuario_rol AFTER INSERT ON users FOR EACH ROW
        EXECUTE PROCEDURE asignarRol();
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_user_trigger');
    }
}
