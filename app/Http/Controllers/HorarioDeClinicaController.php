<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HorarioDeClinica;
use App\Clinica;
use App\Horario;

class HorarioDeClinicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horarioDeClinica=HorarioDeClinica::join('horario', 'horarios_de_clinica.horario_id',  '=' , 'horario.id')
        -> join('clinicas', 'horarios_de_clinica.clinica_id' , '=', 'clinicas.id')
        ->select( 'horarios_de_clinica.id','horarios_de_clinica.horario_id', 'horarios_de_clinica.clinica_id','horario.id','clinicas.id')
        ->orderBy('horarios_de_clinica.id', 'desc')->get(); 
       return $horarioDeClinica;
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
        $horarioDeClinica = new HorarioDeClinica();
        $clinica = Clinica::findOrFail( $request->clinica_id);
        $horario= Horario::findOrFail($request->horario_id);
        
        $horarioDeClinica->clinica()->associate($clinica);
        $horarioDeClinica->horario()->associate($horario);
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
        $clinica = Clinica::findOrFail( $request->clinica_id);
        $horario= Horario::findOrFail($request->horario_id);
        
        $horarioDeClinica->clinica_id()->associate($clinica);
        $horarioDeClinica->horario_id()->associate(horario);
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
        HorarioDeClinica::destroy($request->id);
    }
}
