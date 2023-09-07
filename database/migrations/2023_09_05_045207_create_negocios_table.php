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
        Schema::create('negocio', function (Blueprint $table) {
            $table->id('id_negocio');
            $table->string('nom_negocio',150);
            $table->string('tiempo_negocio',75);
            $table->string('dir_negocio',175);
            $table->double('buena_venta_negocio',8,2);
            $table->double('mala_venta_negocio',8,2);
            $table->double('ganancia_diaria_negocio',8,2);
            $table->double('inversion_diaria_negocio',8,2);
            $table->double('gasto_emp_negocio',8,2);
            $table->double('gasto_alquiler_negocio',8,2);
            $table->double('gasto_impuesto_negocio',8,2);
            $table->double('gasto_otro_negocio',8,2);
            $table->double('gasto_credito_negocio',8,2);
            $table->bigInteger('id_cliente')->unsigned();
            $table->foreign('id_cliente')
              ->references('id_cliente')
              ->on('cliente')
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
        Schema::dropIfExists('negocio');
    }
};
