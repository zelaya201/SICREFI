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
        Schema::create('cuota', function (Blueprint $table) {
            $table->id('id_cuota');
            $table->date('fecha_pago_cuota');
            $table->double('capital_cuota',8,2);
            $table->double('interes_cuota',8,2);
            $table->double('mora_cuota',8,2)->nullable();
            $table->string('estado_cuota',10);
            $table->bigInteger('id_credito')->unsigned();
            $table->foreign('id_credito')
              ->references('id_credito')
              ->on('credito')
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
        Schema::dropIfExists('cuota');
    }
};
