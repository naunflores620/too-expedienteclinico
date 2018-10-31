<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('numero_de_expediente');
            $table->string('profesion')->nullable();
            $table->string('oficio')->nullable();
            $table->string('nombre_del_padre');
            $table->string('nombre_de_la_madre');
            $table->string('nombre_del_conyugue');
            $table->unsignedInteger('persona_id');
            $table->foreign('persona_id')->references('id')->on('persona')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}
