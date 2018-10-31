<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOfertaDeServicioToProfesionalesEnMedicina extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profesionales_en_medicina', function($table) {
            $table->unsignedInteger('oferta_de_servicio_id');
            $table->foreign('oferta_de_servicio_id')->references('id')->on('ofertas_de_servicio')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profesionales_en_medicina', function($table) {
            $table->dropColumn('oferta_de_servicio_id');
        });
    }
}
