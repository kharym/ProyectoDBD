<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaquetesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paquetes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reserva_auto_id')->unsigned();
            $table->integer('reserva_habitacion_id')->unsigned();
            $table->float('precio');
            $table->float('descuento');
            $table->smallInteger('tipo_paquete');
            $table->boolean('disponibilidad');
            $table->timestamps();

            //llaves foraneas
            $table->foreign('reserva_auto_id')->references('id')->on('reserva_autos')->onDelete('cascade');
            $table->foreign('reserva_habitacion_id')->references('id')->on('reserva_habitacions')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paquetes');
    }
}
