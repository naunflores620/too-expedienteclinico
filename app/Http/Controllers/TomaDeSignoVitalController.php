<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\SignoVital;
use \App\consulta;
use \App\TomaDeSignoVital;

class TomaDeSignoVitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tomaSignosVitales = TomaDeSignoVital::join('signos_vitales' , 'toma_de_signo_vital.signovital_id','=','signos_vitales.id')
        -> join('consultas', 'toma_de_signo_vital.consulta_id', '=','consultas.id')
            ->select('toma_de_signo_vital.id','toma_de_signo_vital.valor','toma_de_signo_vital.signovital_id','toma_de_signo_vital.consulta_id', 'signos_vitales.id', 'consultas.id')
            ->orderBy('toma_de_signo_vital.id', 'desc')->get(); 
            return $tomaSignosVitales;
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
        $tomaDeSignoVital = new TomaDeSignoVital();
        $signoVital = SignoVital::findOrFail($request->signovital_id);
        $consulta = Clinica::findOrFail($request->clinica_id);

        $tomaDeSignoVital->valor = $request->valor;
        $tomaDeSignoVital->signovital()->associate($signoVital);
        $tomaDeSignoVital->consulta()->associate($consulta);
        $tomaDeSignoVital->save();
        return $tomaDeSignoVital;
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
        $signoVital = SignoVital::findOrFail($request->signovital_id);
        $consulta = Clinica::findOrFail($request->clinica_id);

        $tomaDeSignoVital->valor = $request->valor;
        $tomaDeSignoVital->signovital()->associate($signoVital);
        $tomaDeSignoVital->consulta()->associate($consulta);
        $tomaDeSignoVital->save();
        return $tomaDeSignoVital;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $tomaDeSignoVital::destroy($request->id);
    }
}
