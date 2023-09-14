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
        Schema::create('opcion_acceso', function (Blueprint $table) {
            $table->id('id_opcion_acceso');
            $table->string('nom_opcion_acceso',75);
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
        Schema::dropIfExists('opcion_acceso');
    }
};
