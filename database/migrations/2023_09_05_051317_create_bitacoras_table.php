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
        Schema::create('bitacora', function (Blueprint $table) {
            $table->id('id_bitacora');
            $table->date('fecha_operacion_bitacora');
            $table->string('tabla_operacion_bitacora',255);
            $table->string('operacion_bitacora',255);
            $table->bigInteger('id_usuario')->unsigned();
            $table->foreign('id_usuario')
              ->references('id_usuario')
              ->on('usuario')
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
        Schema::dropIfExists('bitacora');
    }
};
