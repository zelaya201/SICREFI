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
            $table->double('capital_cuota');
            $table->double('interes_cuota');
            $table->double('extra_cuota')->nullable();
            $table->double('total_cuota');
            $table->double('mora_cuota')->nullable();
            $table->date('fecha_abono_cuota')->nullable();
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
