<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAeropuertosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aeropuertos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ciudad_id')->unsigned();
            $table->string('nombre_aeropuerto',100);
            $table->string('calle_aeropuerto',50);
            $table->integer('numero_aeropuerto');
            $table->timestamps();

            //llaves foraneas
            $table->foreign('ciudad_id')->references('id')->on('ciudads')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aeropuertos');
    }
}
