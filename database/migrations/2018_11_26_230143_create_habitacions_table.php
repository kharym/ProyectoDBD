<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHabitacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habitacions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reserva_habitacion_id')->unsigned();
            $table->integer('alojamiento_id')->unsigned();
            $table->smallInteger('numero_habitacion');
            $table->smallInteger('tipo_habitacion');
            $table->smallInteger('numero_camas');
            $table->smallInteger('numero_banos');
            $table->boolean('disponibilidad');
            $table->timestamps();

            //llaves foraneas
            $table->foreign('reserva_habitacion_id')->references('id')->on('reserva_habitacions')->onDelete('cascade');
            $table->foreign('alojamiento_id')->references('id')->on('alojamientos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('habitacions');
    }
}
