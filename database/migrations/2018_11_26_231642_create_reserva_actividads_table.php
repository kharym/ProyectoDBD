<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservaActividadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva_actividads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('actividad_id');
            $table->float('precio');
            $table->integer('cantidad_personas');   
            $table->date('fecha_reserva');  
            $table->timestamps();
            $table->foreign('actividad_id')->references('id')->on('actividads')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserva_actividads');
    }
}
