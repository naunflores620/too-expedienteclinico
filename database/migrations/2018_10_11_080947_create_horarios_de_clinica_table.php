<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorariosDeClinicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios_de_clinica', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('clinica_id');
            $table->unsignedInteger('horario_id');
            $table->foreign('horario_id')->references('id')->on('horario')->onDelete('cascade');
            $table->foreign('clinica_id')->references('id')->on('clinicas')->onDelete('cascade');
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
        Schema::dropIfExists('horarios_de_clinica');
    }
}
