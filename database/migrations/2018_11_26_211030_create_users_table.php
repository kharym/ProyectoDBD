<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rol_id')->unsigned();
            $table->integer('auditoria_id')->unsigned();
            $table->string('name',50);
            $table->string('apellido',40);
            $table->string('email',450)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->smallInteger('tipo_documento');
            $table->string('numero_documento',15);
            $table->string('pais');
            $table->date('fecha_nacimiento');
            $table->string('telefono',18);
            $table->string('password',60);
            $table->rememberToken();
            $table->timestamps();

            //llaves foraneas
            $table->foreign('rol_id')->references('id')->on('rols')->onDelete('cascade');
            $table->foreign('auditoria_id')->references('id')->on('auditorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
