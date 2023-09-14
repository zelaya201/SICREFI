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
        Schema::create('tel_conyuge', function (Blueprint $table) {
            $table->id('id_tel_conyuge');
            $table->string('tel_conyuge',8);
            $table->bigInteger('id_conyuge')->unsigned();
            $table->foreign('id_conyuge')
              ->references('id_conyuge')
              ->on('conyuge')
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
        Schema::dropIfExists('tel_conyuge');
    }
};
