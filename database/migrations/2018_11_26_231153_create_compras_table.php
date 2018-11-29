<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->integer('actividad_id')->unsigned();
            $table->integer('seguro_id')->unsigned();
            $table->integer('paquete_id')->unsigned();
            $table->integer('reserva_auto_id')->unsigned();
            $table->integer('reserva_habitacion_id')->unsigned();
            $table->date('fecha_compra');
            $table->time('hora_compra');
            $table->timestamps();

            //llaves foraneas
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('actividad_id')->references('id')->on('actividads')->onDelete('cascade');
            $table->foreign('seguro_id')->references('id')->on('seguros')->onDelete('cascade');
            $table->foreign('paquete_id')->references('id')->on('paquetes')->onDelete('cascade');
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
        Schema::dropIfExists('compras');
    }
}
