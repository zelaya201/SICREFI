<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('nom_usuario',75);
            $table->string('ape_usuario',75);
            $table->string('email_usuario',175)->unique();
            $table->string('nick_usuario',75)->unique();
            $table->string('clave_usuario',255);
            $table->string('token_usuario',8)->nullable();
            $table->string('estado_usuario',75);
            $table->bigInteger('id_rol')->unsigned();
            $table->foreign('id_rol')
              ->references('id_rol')
              ->on('rol')
              ->onDelete('cascade');
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
        Schema::dropIfExists('usuario');
    }
};
