<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfertasDeServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ofertas_de_servicio', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('imagen_url');
            $table->float('precio', 8, 2);
            $table->unsignedInteger('servicio_id');
            $table->unsignedInteger('clinica_id');
            $table->foreign('servicio_id')->references('id')->on('servicio')->onDelete('cascade');
            $table->foreign('clinica_id')->references('id')->on('clinicas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ofertas_de_servicio');
    }
}
