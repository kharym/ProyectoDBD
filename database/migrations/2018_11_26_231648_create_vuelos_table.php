<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVuelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vuelos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ciudad_va_id')->unsigned();
            $table->integer('ciudad_viene_id')->unsigned();
            $table->string('origen',100);
            $table->string('destino',100);
            $table->float('precio_vuelo');
            $table->smallInteger('cantidad_asientos');
            $table->date('fecha_ida');
            $table->time('hora_ida');    
            $table->date('fecha_llegada');
            $table->time('hora_llegada');   
            $table->time('duracion_viaje'); 
            $table->timestamps();

            //llaves foraneas
            $table->foreign('ciudad_va_id')->references('id')->on('ciudads')->onDelete('cascade');
            $table->foreign('ciudad_viene_id')->references('id')->on('ciudads')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vuelos');
    }
}
