<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paciente;
use App\Persona;
class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = Paciente::all();
        return $pacientes;
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
        $paciente = new Paciente();
        $paciente->numero_de_expediente = $request->numero_de_expediente;
        if(isset($request->profesion)){
            $paciente->profesion = $request->profesion;
        }
        else if(isset($request->oficio)){
            $paciente->oficio = $request->oficio;
        }
        $paciente->nombre_del_padre = $request->nombre_del_padre;
        $paciente->nombre_de_la_madre = $request->nombre_de_la_madre;
        $paciente->nombre_de_conyugue = $request->nombre_de_conyugue;
        // Obteniendo la persona
        $persona = Persona::findOrFail($request->persona_id);
        $paciente->persona()->associate($persona);

        // Guardandolo en la base de datos
        $paciente->save();
        return $paciente;
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
        $paciente = Paciente::findOrFail($request->id);
        $paciente->numero_de_expediente = $request->numero_de_expediente;
        if(isset($request->profesion)){
            $paciente->profesion = $request->profesion;
        }
        else if(isset($request->oficio)){
            $paciente->oficio = $request->oficio;
        }
        $paciente->nombre_del_padre = $request->nombre_del_padre;
        $paciente->nombre_de_la_madre = $request->nombre_de_la_madre;
        $paciente->nombre_de_conyugue = $request->nombre_de_conyugue;
        // Obteniendo la persona
        $persona = Persona::findOrFail($request->persona_id);
        $paciente->persona()->associate($persona);

        // Guardandolo en la base de datos
        $paciente->save();
        return $paciente;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Paciente::destroy($request->id);
    }
}
