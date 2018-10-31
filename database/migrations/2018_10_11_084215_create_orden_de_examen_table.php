<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenDeExamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_de_examen', function (Blueprint $table) {
            $table->increments('id');
            $table->string('resultadoEscaneado');
            $table->string('razonDeLaOrden');
            $table->unsignedInteger('examen_id');
            $table->unsignedinteger('consulta_id');
            $table->foreign('examen_id')->references('id')->on('examen')->onDelete('cascade');
            $table->foreign('consulta_id')->references('id')->on('consultas')->onDelete('cascade');
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
        Schema::dropIfExists('orden_de_examen');
    }
}
