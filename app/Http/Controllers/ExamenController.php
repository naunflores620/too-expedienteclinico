<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Examen;

class ExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio =$request->criterio;

        if($buscar==''){
       
            $examenes = Examen::orderBy('id','desc')->paginate(2);
        }
        else{
            $examenes = Examen::where($criterio,'like', '%' . $buscar . '%')-> orderBy('id','desc')->paginate(2);

        }

        return [
            'pagination' => [
                'total'         => $examenes->total(),
                'current_page'  => $examenes->currentPage(),
                'per_page'      => $examenes->perPage(),
                'last_page'     => $examenes->lastPage(),
                'from'          => $examenes->firstItem(),
                'to'            => $examenes->lastItem(),
                ],
                'examenes' =>$examenes
            ];
    }
    
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $examen = new Examen();
        $examen->nombre = $request->nombre;
        $examen->descripcion = $request->descripcion;
        $examen->save();
       
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
        $examen = Examen::findOrFail($request->id);
        $examen->nombre = $request->nombre;
        $examen->descripcion = $request->descripcion;
        $examen->save();
    }

    public function desactivar(Request $request)
    {
        $examen = Examen::findOrFail($request->id);
        $examen->condicion = '0';
        $examen->save();
    }


    public function activar(Request $request)
    {
        $examen = Examen::findOrFail($request->id);
        $examen->condicion = '1';
        $examen->save();
    }


}
