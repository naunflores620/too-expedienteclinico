<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProfesionalEnMedicina;
use App\Especialidad;

class ProfesionalEnMedicinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profesionales_en_medicina = ProfesionalEnMedicina::all();
        return $profesionales_en_medicina;
    }

    public function buscarMedico()
    {
        $medico = ProfesionalEnMedicina::all();
        return $medico;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Creando un profesional en el area de medicina
        $profesional_en_medicina = new ProfesionalEnMedicina();

        // Obteneindo las entidades con las que se relaciona
        $trabajador = App\Trabajador::findOrFail($request->trabajador_id);
        $especialidad = App\Especialidad::findOrFail($request->especialidad_id);
        $ofertaservicio = App\OfertaDeServicio::findOrFail($request->oferta_de_servicio_id);

        $profesional_en_medicina->JVPM = $request->JVPM;

        // guardando en la BD
        $profesional_en_medicina->save();

        return $profesional_en_medicina;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $profesional_en_medicina = ProfesionalEnMedicina::findOrFail($request->id);

        // Obteneindo las entidades con las que se relaciona
        $trabajador = App\Trabajador::findOrFail($request->trabajador_id);
        $especialidad = App\Especialidad::findOrFail($request->especialidad_id);
        $ofertaservicio = App\OfertaDeServicio::findOrFail($request->oferta_de_servicio_id);

        $profesional_en_medicina->JVPM = $request->JVPM;

        // guardando en la BD
        $profesional_en_medicina->save();

        return $profesional_en_medicina;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        ProfesionalEnMedicina::destroy($request->id);
    }
}
