<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioMedioDePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario__medio_de_pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('medio_de_pago_id')->unsigned();
            $table->timestamps();

            //llaves foraneas
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('medio_de_pago_id')->references('id')->on('medio_de_pagos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario__medio_de_pagos');
    }
}
