<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompraReservaVuelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra__reserva_vuelos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('compra_id')->unsigned();
            $table->integer('reservaVuelo_id')->unsigned();
            $table->timestamps();

            //llaves foraneas
            $table->foreign('compra_id')->references('id')->on('compras')->onDelete('cascade');
            $table->foreign('reservaVuelos_id')->references('id')->on('reserva_vuelos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compra__reserva_vuelos');
    }
}
