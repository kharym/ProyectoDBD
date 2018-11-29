<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservaAutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva_autos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('auto_id')->unsigned();
            $table->float('precio_auto');
            $table->date('fecha_recogido');   
            $table->date('fecha_devolucion');
            $table->time('hora_recogido');   
            $table->time('hora_devolucion');
            $table->smallInteger('tipo_auto');
            $table->timestamps();

            //llaves foraneas
            $table->foreign('auto_id')->references('id')->on('autos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserva_autos');
    }
}
