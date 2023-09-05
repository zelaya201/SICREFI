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
        Schema::create('tel_cliente', function (Blueprint $table) {
            $table->id('id_tel_cliente');
            $table->string('tel_cliente',8);
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
        Schema::dropIfExists('tel_cliente');
    }
};
