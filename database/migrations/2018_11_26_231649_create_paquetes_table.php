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
            $table->integer('auto_id')->unsigned()->nullable();
            $table->integer('habitacion_id')->unsigned()->nullable();
            $table->integer('vuelo_id')->unsigned()->nullable();
            $table->integer('pasajeros')->nullable();
            $table->float('precio');
            $table->float('descuento');
            $table->smallInteger('tipo_paquete');
            $table->boolean('disponibilidad');
            $table->timestamps();

            //llaves foraneas
            $table->foreign('auto_id')->references('id')->on('autos')->onDelete('cascade');
            $table->foreign('habitacion_id')->references('id')->on('habitacions')->onDelete('cascade');
            $table->foreign('vuelo_id')->references('id')->on('vuelos')->onDelete('cascade');
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
