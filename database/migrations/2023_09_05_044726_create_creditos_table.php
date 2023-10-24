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
        Schema::create('credito', function (Blueprint $table) {
            $table->id('id_credito');
            $table->double('monto_credito', 8,2);
            $table->double('desembolso_credito', 8,2);
            $table->date('fecha_emision_credito');
            $table->date('fecha_vencimiento_credito');
            $table->double('tasa_interes_credito',8,2);
            $table->double('monto_neto_credito',8,2);
            $table->double('monto_cuota_credito',8,2);
            $table->integer('n_cuotas_credito');
            $table->string('frecuencia_credito',30);

            $table->string('tipo_credito',30);
            $table->string('estado_credito',70);

            $table->bigInteger('id_cliente')->unsigned();
            $table->foreign('id_cliente')
              ->references('id_cliente')
              ->on('cliente')
              ->onDelete('cascade');
            $table->bigInteger('id_coop')->unsigned();
            $table->foreign('id_coop')
              ->references('id_coop')
              ->on('cooperativa')
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
        Schema::dropIfExists('credito');
    }
};
