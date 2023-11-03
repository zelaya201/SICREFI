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
      Schema::create('credito_referencia', function (Blueprint $table) {
        $table->id('id_credito_referencia');
        $table->bigInteger('id_credito')->unsigned();
        $table->foreign('id_credito')
          ->references('id_credito')
          ->on('credito')
          ->onDelete('cascade');
        $table->bigInteger('id_ref')->unsigned();
        $table->foreign('id_ref')
          ->references('id_ref')
          ->on('referencia')
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
        //
    }
};
