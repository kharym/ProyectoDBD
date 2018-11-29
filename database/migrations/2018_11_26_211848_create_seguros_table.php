<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSegurosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguros', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('edad_pasajero');
            $table->boolean('ida_vuelta');
            $table->smallInteger('cantidad_personas');
            $table->date('fecha_ida');
            $table->date('fecha_vuelta');
            $table->string('destino',40);
            $table->float('costo_pasaje');
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
        Schema::dropIfExists('seguros');
    }
}
