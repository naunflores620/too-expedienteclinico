<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProfesionalEnMedicina;
use App\Paciente;
use App\Consulta;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consulta =Consulta::join('profesionales_en_medicina', 'consultas.profesional_en_medicina_id',  '=' , 'profesionales_en_medicina.id')
                                -> join('pacientes', 'consultas.paciente_id' , '=', 'pacientes.id')
                                ->select('consultas.id', 'consultas.sintomatologia', 'consultas.diagnostico', 'consultas.profesional_en_medicina_id', 'consultas.paciente_id')
                                ->orderBy('consultas.id', 'desc')->get(); 
        return $consulta;
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
        $consulta = new Consulta();
        $profesionalEnMedicina = ProfesionalEnMedicina::findOrFail( $request->profesional_en_medicina_id);
        $paciente = Paciente::findOrFail($request->paciente_id);
        
        $consulta->sintomatologia = $request->sintomatologia;
        $consulta->diagnostico = $request->diagnostico;
        $consulta->profesional_medico()->associate($profesionalEnMedicina);
        $consulta->paciente()->associate($paciente);
        return $consulta;
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
        $profesionalEnMedicina = ProfesionalEnMedicina::findOrFail( $request->profesional_en_medicina_id);
        $paciente = Paciente::findOrFail($request->paciente_id);
        
        $consulta->sintomatologia = $request->sintomatologia;
        $consulta->diagnostico = $request->diagnostico;
        $consulta->profesional_medico()->associate($profesionalEnMedicina);
        $consulta->paciente()->associate($paciente);
        $consulta->save();
        return $consulta;
    
    }

   /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Consulta ::destroy($request->id);
    }
}
