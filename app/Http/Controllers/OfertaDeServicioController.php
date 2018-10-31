<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OfertaDeServicio;

class OfertaDeServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ofertas_de_servicios = OfertaDeServicio::all();
        return $ofertas_de_servicios;
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
        // creando el objeto OfertaDeServicio
        $oferta_de_servicio = new OfertaDeServicio();

        // objetos de la relación
        $servicio = App\Servicio::findOrFail($request->servicio_id);
        $clinica = App\Clinica::findOrFail($request->clinica_id);

        $oferta_de_servicio->precio = $request->precio;
        $oferta_de_servicio->imagen_url = $request->imagen_url;

        // asociando las entidades
        $oferta_de_servicio->servicio()->associate($servicio);
        $oferta_de_servicio->clinica()->associate($clinica);

        $oferta_de_servicio->save();

        return $oferta_de_servicio;
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
        // creando el objeto OfertaDeServicio
        $oferta_de_servicio = OfertaDeServicio::findOrFail($request->id);

        // objetos de la relación
        $servicio = App\Servicio::findOrFail($request->servicio_id);
        $clinica = App\Clinica::findOrFail($request->clinica_id);

        $oferta_de_servicio->precio = $request->precio;
        $oferta_de_servicio->imagen_url = $request->imagen_url;

        // asociando las entidades
        $oferta_de_servicio->servicio()->associate($servicio);
        $oferta_de_servicio->clinica()->associate($clinica);

        $oferta_de_servicio->save();

        return $oferta_de_servicio;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        OfertaDeServicio::destroy($request->id);
    }
}
