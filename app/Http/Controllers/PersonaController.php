<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Clinica;
use App\Direccion;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas = Persona::all();
        return $personas;
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
        // creando el objeto persona
        $persona = new Persona();

        // obteniendo las entidades con las que se relaciona
        $direccion = Direccion::findOrFail($request->direccion_id);
        if(isset($request->clinica_id)){
            $clinica = Clinica::findOrFail($request->clinica_id);
            $persona->clinica()->associate($clinica);
        }
        
        // asignandole valores a sus atributos
        $persona->nombre = $request->nombre;
        $persona->apellidos = $request->apellidos;
        $persona->fechaDeNacimiento = $request->fechaDeNacimiento;
        $persona->estadoCivil = $request->estadoCivil;
        $persona->genero = $request->genero;
        $persona->documentoDeIdentidad = $request->documentoDeIdentidad;
        $persona->direccion()->associate($direccion);
        
        $persona->save();
        return $persona;
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
        // obteniendo el objeto persona
        $persona = Persona::findOrFail($request->id);
        // obteniendo las entidades con las que se relaciona
        $direccion = Direccion::findOrFail($request->direccion_id);
        if(isset($request->clinica_id)){
            $clinica = Clinica::findOrFail($request->clinica_id);
            $persona->clinica()->associate($clinica);
        }
        
        // asignandole valores a sus atributos
        $persona->nombre = $request->nombre;
        $persona->apellidos = $request->apellidos;
        $persona->fechaDeNacimiento = $request->fechaDeNacimiento;
        $persona->estadoCivil = $request->estadoCivil;
        $persona->genero = $request->genero;
        $persona->direccion()->associate($direccion);
        
        $persona->save();
        return $persona;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Persona::destroy($request->id);
    }
}
