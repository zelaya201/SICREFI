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
        Schema::create('tel_referencia', function (Blueprint $table) {
            $table->id('id_tel_ref');
            $table->string('tel_ref',8);
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
     *d
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tel_referencia');
    }
};
