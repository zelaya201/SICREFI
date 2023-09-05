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
        Schema::create('cliente', function (Blueprint $table) {
          $table->id('id_cliente');
          $table->string('dui_cliente', 10)->unique();
          $table->string('primer_nom_cliente', 50);
          $table->string('segundo_nom_cliente', 50)->nullable();
          $table->string('tercer_nom_cliente', 50)->nullable();
          $table->string('primer_ape_cliente', 50);
          $table->string('segundo_ape_cliente', 50)->nullable();
          $table->date('fech_nac_cliente');
          $table->string('dir_cliente', 150);
          $table->string('email_cliente', 200)->unique();
          $table->string('tipo_vivienda_cliente', 75);
          $table->string('ocupacion_cliente', 75);
          $table->double('gasto_aliment_cliente', 8, 2);
          $table->double('gasto_agua_cliente', 8, 2);
          $table->double('gasto_luz_cliente', 8, 2);
          $table->double('gasto_cable_cliente', 8, 2);
          $table->double('gasto_vivienda_cliente', 8, 2);
          $table->double('gasto_otro_cliente', 8, 2);
          $table->string('estado_cliente', 75);
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
        Schema::dropIfExists('cliente');
    }
};
