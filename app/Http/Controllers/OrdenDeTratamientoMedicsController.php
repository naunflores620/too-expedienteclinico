<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdenDeTratamientoMedicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordenDeTratamintoMedico = OrdenDeTratamientoMedico::join('clinica', 'ordenDeTratamintoMedico.clinica_id', '=','clinica.id')
           -> join('tratamiento_medico', 'ordenDeTratamintoMedico.tratamiento_medicos_id', '=','tratamientos_medicos.id')
            ->select('ordenDeTratamintoMedico.id','ordenDeTratamintoMedico.indicaciondes','ordenDeTratamintoMedico.razon_del_tratamiento','ordenDeTratamintoMedico.consulta_id','ordenDeTratamintoMedico.tratamiento_medico_id')
            ->orderBy('ordenDeTratamintoMedico.id', 'desc')->get();  
        return $ordenDeTratamintoMedico;
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
        $ordenDeTratamintoMedico = new OrdenDeTratamintoMedico();
        $clinica = clinica::findOrFail($request->clinica_id);
        $tratamientoMedico = TratamientoMedico::findOrFail($request->tratamientos_medicos_id);
        
        $ordenDeTratamintoMedico->indicaciones = $request->indicaciones;
        $ordenDeTratamintoMedico->razon_del_tratamiento = $request->razon_del_tratamiento;
        $ordenDeTratamintoMedico->consulta()->associate($consulta);
        $ordenDeTratamintoMedico->tratamiento_medico()->associate($tratamientos_medicos);
        $ordenDeTratamintoMedico->save();
        return $ordenDeTratamintoMedico;
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
    public function update(Request $request, $id)
    {
        $clinica = clinica::findOrFail($request->clinica_id);
        $tratamientoMedico = TratamientoMedico::findOrFail($request->tratamientos_medicos_id);
        
        $ordenDeTratamintoMedico->indicaciones = $request->indicaciones;
        $ordenDeTratamintoMedico->razon_del_tratamiento = $request->razon_del_tratamiento;
        $ordenDeTratamintoMedico->consulta()->associate($consulta);
        $ordenDeTratamintoMedico->tratamiento_medico()->associate($tratamientos_medicos);
        $ordenDeTratamintoMedico->save();
        return $ordenDeTratamintoMedico;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ordenDeTratamintoMedico::destroy($request->id);
    }
}
