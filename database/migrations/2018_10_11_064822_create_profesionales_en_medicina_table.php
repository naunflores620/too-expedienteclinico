<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfesionalesEnMedicinaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profesionales_en_medicina', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('JVPM');
            $table->unsignedInteger('trabajador_id');
            $table->foreign('trabajador_id')->references('id')->on('trabajadores');
            $table->unsignedInteger('especialidad_id');
            $table->foreign('especialidad_id')->references('id')->on('especialidades');
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
        Schema::dropIfExists('profesionales_en_medicina');
    }
}
