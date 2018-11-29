<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asientos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vuelo_id')->unsigned();
            $table->smallInteger('numero_asiento');
            $table->boolean('disponibilidad');
            $table->smallInteger('tipo_asiento');
            $table->timestamps();

            //llaves foraneas
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
        Schema::dropIfExists('asientos');
    }
}
