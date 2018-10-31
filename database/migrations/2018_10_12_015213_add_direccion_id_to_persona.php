<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDireccionIdToPersona extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('persona', function($table) {
            $table->unsignedInteger('direccion_id');
            $table->foreign('direccion_id')->references('id')->on('direcciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('persona', function($table) {
            $table->dropColumn('direccion_id');
        });
    }
}
