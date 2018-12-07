<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservaHabitacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva_habitacions', function (Blueprint $table) {
            $table->increments('id');
            $table->float('precio_res_hab');
            $table->date('fecha_llegada');   
            $table->date('fecha_ida');  
            $table->smallInteger('numero_ninos');
            $table->smallInteger('numero_adulto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserva_habitacions');
    }
}
