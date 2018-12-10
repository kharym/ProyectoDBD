<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ciudad_id')->unsigned();
            $table->string('nombre_empresa',50);
            $table->string('telefono_empresa');
            $table->string('correo_empresa',250);
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
        Schema::dropIfExists('empresas');
    }
}
