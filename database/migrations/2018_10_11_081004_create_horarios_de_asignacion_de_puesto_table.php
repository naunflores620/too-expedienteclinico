<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorariosDeAsignacionDePuestoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios_de_asignacion_de_puesto', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('horario_id');
            $table->unsignedInteger('asignacion_puesto_id');
            $table->foreign('horario_id')->references('id')->on('horario')->onDelete('cascade');
            $table->foreign('asignacion_puesto_id')->references('id')->on('asignacion_puesto')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horarios_de_asignacion_de_puesto');
    }
}
