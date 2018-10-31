<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Persona;
use App\Trabajador;


class TrabajadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trabajador = Trabajador::join('persona', 'trabajadores.persona_id','=', 'persona.id')
                                ->select('trabajadores.id', 'trabajadores.nit','trabajadores.nup','trabajadpres.persona_id', 'persona.id')
                                ->orderBy('trabajador.id','desc')->get();
                                return $trabajador;
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
        $trabajador = new Trabajador();
        $persona = Persona::FindOrFail($request->persona_id);
        $trabajador->nit = $request->nit;
        $trabajador->nup = $request->nup;
        $trabajador->persona_id->associate($persona);
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
        $persona = Persona::FindOrFail($request->persona_id);
        $trabajador->nit = $request->nit;
        $trabajador->nup = $request->nup;
        $trabajador->persona_id->associate($persona);
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
        Trabajador::destroy($request->id);
    }
}
