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
        Schema::create('referencia', function (Blueprint $table) {
            $table->id('id_ref');
            $table->string('primer_nom_ref',50);
            $table->string('segundo_nom_ref',50)->nullable();
            $table->string('tercer_nom_ref',50)->nullable();
            $table->string('primer_ape_ref',50);
            $table->string('segundo_ape_ref',50)->nullable();
            $table->string('dir_ref');
            $table->string('ocupacion_ref',75);
            $table->string('parentesco_ref',75);
            $table->string('estado_ref',75);
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
        Schema::dropIfExists('referencia');
    }
};
