<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Especialidad;


class EspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if (!$request->ajax()) return redirect('/');

        $buscar=$request->buscar;
        $criterio=$request->criterio;

        if($buscar==''){
            $especialidades = Especialidad::orderBy('id', 'desc')->paginate(3);
        }
        else {
            $especialidades = Especialidad::where($criterio,'like','%'. $buscar .'%')->orderBy('id','desc')->paginate(3);
        }

        return [
            'pagination'=> [
                'total'        => $especialidades->total(),
                'current_page' => $especialidades->currentPage(),
                'per_page'     => $especialidades->perPage(),
                'last_page'    => $especialidades->lastPage(),
                'from'         => $especialidades->firstItem(),
                'to'           => $especialidades->lastItem(),
            ],
            'especialidades'=> $especialidades
        ];

     
       
    }
    
    public function selectEspecialidad(Request $request){
 
        if (!$request->ajax()) return redirect('/');
        $especialidades = Especialidad::where('id', '!=','0') //OJOOOOOO!!! YO LE PUSE ESTA WHERE PORQUE EN EL CURSO ESTABA QUE SI: "where('condicion','=','1')"
                                                              //PERO COMO NOSOTROS NO TENEMOS ESO NO SABIA QUE PONERLE Y COLOCARLE OTRA COSA ME DABA ERROR O NO ME APARECIA. NO SE SI ESTA BIEN
        ->select('id','especialidad')->orderBy('especialidad','asc')->get();
        return ['especialidades' => $especialidades];
    
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
        if (!$request->ajax()) return redirect('/');
        $especialidad = new Especialidad();
        $especialidad->especialidad = $request->especialidad;
        $especialidad->save();
        return $especialidad;
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
        if (!$request->ajax()) return redirect('/');
        $especialidad = Especialidad::findOrFail($request->id);
        $especialidad->especialidad = $request->especialidad;
        $especialidad->save();
        return $especialidad;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Especialidad::destroy($request->id);
    }
}
