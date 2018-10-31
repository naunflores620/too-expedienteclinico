<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenesDeTratamientoMedicoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes_de_tratamiento_medico', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('indicaciones');
            $table->string('razon_del_tratamiento');
            $table->unsignedInteger('consulta_id');
            $table->unsignedInteger('tratamiento_medico_id');
            $table->foreign('consulta_id')->references('id')->on('consultas')->onDelete('cascade');
            $table->foreign('tratamiento_medico_id')->references('id')->on('tratamientos_medicos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordenes_de_tratamiento_medico');
    }
}
