<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Servicio;


class ServicioController extends Controller
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
        
        //"servicio" y "especialidades" son las tablas de la BD, al igual que cada uno de los campos luego del punto, son las respectivas columnas de cada tabla
        if($buscar==''){
            $servicios = Servicio::join('especialidades','servicio.especialidad_id','=','especialidades.id')
            ->select('servicio.id','servicio.especialidad_id','servicio.servicio','servicio.descripcion','especialidades.especialidad as nombre_especialidad')
            ->orderBy('servicio.id', 'desc')->paginate(3);
        }
        else {
            $servicios = Servicio::join('especialidades','servicio.especialidad_id','=','especialidades.id')
            ->select('servicio.id','servicio.especialidad_id','servicio.servicio','servicio.descripcion','especialidades.especialidad as nombre_especialidad')
            ->where('servicio.'.$criterio,'like','%'. $buscar .'%')
            ->orderBy('servicio.id', 'desc')->paginate(3);

        }

        return [
            'pagination'=> [
                'total'        => $servicios->total(),
                'current_page' => $servicios->currentPage(),
                'per_page'     => $servicios->perPage(),
                'last_page'    => $servicios->lastPage(),
                'from'         => $servicios->firstItem(),
                'to'           => $servicios->lastItem(),
            ],
            'servicios'=> $servicios
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
        if (!$request->ajax()) return redirect('/');
        $servicio = new Servicio();
        //$especialidad = Especialidad::FindOrFail($request->especialidad_id); VER SI SE BORRA LUEGO
        $servicio-> especialidad_id = $request->especialidad_id;
        $servicio-> servicio = $request->servicio;
        $servicio-> descripcion = $request->descripcion;
       // $servicio->especialidad()->associate($especialidad);  VER SI SE BORRA LUEGO
       $servicio-> save();
      
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
        $servicio = Servicio::findOrFail($request->id);
        $servicio->especialidad_id = $request->especialidad_id;
        $servicio->servicio = $request->servicio;
        $servicio->descripcion = $request->descripcion;
        //$servicio->especialidad()->associate($especialidad);
        $servicio->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $reques)
    {
        Servicios::destroy($request->id);
    }
}
