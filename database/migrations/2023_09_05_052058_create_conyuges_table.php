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
        Schema::create('conyuge', function (Blueprint $table) {
            $table->id('id_conyuge');
            $table->string('primer_nom_conyuge',50);
            $table->string('segundo_nom_conyuge',50)->nullable();
            $table->string('tercer_nom_conyuge',50)->nullable();
            $table->string('primer_ape_conyuge',50);
            $table->string('segundo_ape_conyuge',50)->nullable();
            $table->string('dir_conyuge',175);
            $table->string('ocupacion_conyuge',75);
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
        Schema::dropIfExists('conyuge');
    }
};
