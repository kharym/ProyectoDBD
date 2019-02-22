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
            $table->integer('rol_id')->nullable()->unsigned();
            $table->integer('auditoria_id')->nullable()->unsigned();
            $table->string('name',50);
            $table->string('apellido',40)->nullable();
            $table->string('email',450)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->smallInteger('tipo_documento')->nullable();
            $table->string('numero_documento',15)->nullable();
            $table->string('pais')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('telefono',18)->nullable();
            $table->string('password',60)->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
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
