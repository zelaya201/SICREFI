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
        Schema::create('credito_bien', function (Blueprint $table) {
            $table->bigInteger('id_credito')->unsigned();
            $table->foreign('id_credito')
              ->references('id_credito')
              ->on('credito')
              ->onDelete('cascade');
            $table->bigInteger('id_bien')->unsigned();
            $table->foreign('id_bien')
              ->references('id_bien')
              ->on('bien')
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
        Schema::dropIfExists('credito_bien');
    }
};
