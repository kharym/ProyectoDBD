<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasajerosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasajeros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->string('apellido',40);
            $table->string('dni_pasaporte');
            $table->string('pais',40);
            $table->boolean('menor_edad');
            $table->string('telefono');
            $table->boolean('asistencia_especial');
            $table->boolean('movilidad_reducida');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pasajeros');
    }
}
