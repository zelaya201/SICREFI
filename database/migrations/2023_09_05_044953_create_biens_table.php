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
        Schema::create('bien', function (Blueprint $table) {
            $table->id('id_bien');
            $table->string('nom_bien',75);
            $table->string('descrip_bien');
            $table->double('valor_bien', 8, 2);

            $table->string('estado_bien',75);
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
        Schema::dropIfExists('bien');
    }
};
