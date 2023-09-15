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
        Schema::table('referencia', function (Blueprint $table) {
            //
            $table->string('parentesco_ref', 150)->after('ocupacion_ref');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('referencia', function (Blueprint $table) {
            //
            $table->dropColumn('parentezco_ref');
        });
    }
};
