<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaqueteReservaVuelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paquete__reserva_vuelos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('paquete_id')->unsigned();
            $table->integer('reservaVuelo_id')->unsigned();
            $table->timestamps();

            //llaves foraneas
            $table->foreign('paquete_id')->references('id')->on('paquetes')->onDelete('cascade');
            $table->foreign('reservaVuelo_id')->references('id')->on('reserva_vuelos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paquete__reserva_vuelos');
    }
}
