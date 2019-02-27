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
            $table->integer('alojamiento_id')->unsigned();
            $table->smallInteger('numero_habitacion');
            $table->smallInteger('tipo_habitacion');
            $table->smallInteger('numero_camas');
            $table->smallInteger('numero_banos');
            $table->smallInteger('capacidad_ninos');
            $table->smallInteger('capacidad_adultos');
            $table->float('precio');
            $table->boolean('disponibilidad');
            $table->timestamps();

            //llaves foraneas
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
