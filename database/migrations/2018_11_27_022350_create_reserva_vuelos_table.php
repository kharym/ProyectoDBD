<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservaVuelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva_vuelos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vuelo_id')->unsigned();
            $table->integer('asiento_id')->unsigned();
            $table->integer('pasajero_id')->unsigned();
            $table->boolean('ida_vuelta');
            $table->smallInteger('cantidad_pasajeros');
            $table->smallInteger('tipo_cabina');
            $table->date('fecha_reserva');   
            $table->time('hora_reserva');   
            $table->float('precio_reserva_vuelo');
            $table->smallInteger('cantidad_paradas');
            $table->timestamps();

            //llaves foraneas
            $table->foreign('vuelo_id')->references('id')->on('vuelos')->onDelete('cascade');
            $table->foreign('asiento_id')->references('id')->on('asientos')->onDelete('cascade');
            $table->foreign('pasajero_id')->references('id')->on('pasajeros')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserva_vuelos');
    }
}
