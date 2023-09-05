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
        Schema::create('detalle_acceso', function (Blueprint $table) {
            $table->id('id_detalle_acceso');
            $table->string('nom_detalle_acceso',255);
            $table->bigInteger('id_opcion_acceso')->unsigned();
            $table->foreign('id_opcion_acceso')
              ->references('id_opcion_acceso')
              ->on('opcion_acceso')
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
        Schema::dropIfExists('detalle_acceso');
    }
};
