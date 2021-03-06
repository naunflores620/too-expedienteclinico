<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SignoVital;

class SignoVitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       // if (!$request->ajax()) return redirect('/');

        $buscar=$request->buscar;
        $criterio=$request->criterio;

        if($buscar==''){
            $signoVital = SignoVital::orderBy('id', 'desc')->paginate(3);
        }
        else {
            $signoVital = SignoVital::where($criterio,'like','%'. $buscar .'%')->orderBy('id','desc')->paginate(3);
        }

        return [
            'pagination'=> [
                'total'        => $signoVital->total(),
                'current_page' => $signoVital->currentPage(),
                'per_page'     => $signoVital->perPage(),
                'last_page'    => $signoVital->lastPage(),
                'from'         => $signoVital->firstItem(),
                'to'           => $signoVital->lastItem(),
            ],
            'signoVital'=> $signoVital
        ];
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
        $signoVital = new SignoVital();
        $signoVital->nombre = $request->nombre;
        $signoVital->unidadDeMedida = $request->unidadDeMedida;
        $signoVital->save();
         return $signoVital;
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
        $signoVital = SignoVital::findOrFail($request->id);
        $signoVital->nombre = $request->nombre;
        $signoVital->unidadDeMedida = $request->unidadDeMedida;
        $signoVital->save();
        return $signoVital;
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       SignoVital::destroy( $request->id); 

    }
}
