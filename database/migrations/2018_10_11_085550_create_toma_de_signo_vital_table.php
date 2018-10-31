<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTomaDeSignoVitalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toma_de_signo_vital', function (Blueprint $table) {
            $table->increments('id');
            $table->float('valor', 8, 2);
            $table->unsignedInteger('consulta_id');
            $table->unsignedInteger('signovital_id');
            $table->foreign('consulta_id')->references('id')->on('consultas')->onDelete('cascade');
            $table->foreign('signovital_id')->references('id')->on('signos_vitales')->onDelete('cascade');
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
        Schema::dropIfExists('toma_de_signo_vital');
    }
}
