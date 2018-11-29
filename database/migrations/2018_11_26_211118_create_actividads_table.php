<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('destino',40);
            $table->string('nombre_actividad',100);
            $table->float('precio');
            $table->smallInteger('cantidad_adulto');
            $table->smallInteger('cantidad_ninos');
            $table->date('fecha_ida');   
            $table->date('fecha_vuelta');
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
        Schema::dropIfExists('actividads');
    }
}
