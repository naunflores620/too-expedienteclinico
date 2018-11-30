<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProfesionalEnMedicina;

class ProfesionalEnMedicinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       /* $profesionales_en_medicina = ProfesionalEnMedicina::all();
        return $profesionales_en_medicina;*/

       if (!$request->ajax()) return redirect('/');

        $buscar=$request->buscar;
        $criterio=$request->criterio;

        if($buscar==''){
            $profesionalesEnMedicina = ProfesionalEnMedicina::join('especialidades','profesionales_en_medicina.especialidad_id','=','especialidades.id')
            ->join('trabajadores','profesionales_en_medicina.trabajador_id','=','trabajadores.id')
            ->select('profesionales_en_medicina.id', 'profesionales_en_medicina.JVPM','profesionales_en_medicina.especialidad_id','especialidades.especialidad','profesionales_en_medicina.trabajador_id','trabajadores.nit')
            ->orderBy('profesionales_en_medicina.id', 'asc')->paginate(3);
        }
        else {
            
            $profesionalesEnMedicina = ProfesionalEnMedicina::join('especialidades','profesionales_en_medicina.especialidad_id','=','especialidades.id')
            ->join('trabajadores','profesionales_en_medicina.trabajador_id','=','trabajadores.id')
            ->select('profesionales_en_medicina.id', 'profesionales_en_medicina.JVPM','profesionales_en_medicina.especialidad_id','especialidades.especialidad','profesionales_en_medicina.trabajador_id','trabajadores.nit')
            ->where('profesionales_en_medicina.'.$criterio,'like','%'. $buscar .'%')            
            ->orderBy('profesionales_en_medicina.id', 'asc')->paginate(3);
            
        }

        return [
            'pagination'=> [
                'total'        => $profesionalesEnMedicina->total(),
                'current_page' => $profesionalesEnMedicina->currentPage(),
                'per_page'     => $profesionalesEnMedicina->perPage(),
                'last_page'    => $profesionalesEnMedicina->lastPage(),
                'from'         => $profesionalesEnMedicina->firstItem(),
                'to'           => $profesionalesEnMedicina->lastItem(),
            ],
            'profesionalesEnMedicina'=> $profesionalesEnMedicina
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
      /*  // Creando un profesional en el area de medicina
        $profesional_en_medicina = new ProfesionalEnMedicina();

        // Obteneindo las entidades con las que se relaciona
        $trabajador = App\Trabajador::findOrFail($request->trabajador_id);
        $especialidad = App\Especialidad::findOrFail($request->especialidad_id);
        $ofertaservicio = App\OfertaDeServicio::findOrFail($request->oferta_de_servicio_id);

        $profesional_en_medicina->JVPM = $request->JVPM;

        // guardando en la BD
        $profesional_en_medicina->save();

        return $profesional_en_medicina;*/

        if (!$request->ajax()) return redirect('/');
        $profesionalEnMedicina = new ProfesionalEnMedicina();
        $profesionalEnMedicina->JVPM = $request->JVPM;
        $profesionalEnMedicina->especialidad_id = $request->especialidad_id;
        $profesionalEnMedicina->trabajador_id = $request->trabajador_id;
        $profesionalEnMedicina->save();
      
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
      /*  $profesional_en_medicina = ProfesionalEnMedicina::findOrFail($request->id);

        // Obteneindo las entidades con las que se relaciona
        $trabajador = App\Trabajador::findOrFail($request->trabajador_id);
        $especialidad = App\Especialidad::findOrFail($request->especialidad_id);
        $ofertaservicio = App\OfertaDeServicio::findOrFail($request->oferta_de_servicio_id);

        $profesional_en_medicina->JVPM = $request->JVPM;

        // guardando en la BD
        $profesional_en_medicina->save();

        return $profesional_en_medicina;*/

        if (!$request->ajax()) return redirect('/');
        $profesionalEnMedicina = ProfesionalEnMedicina::findOrFail($request->id);
        $profesionalEnMedicina->JVPM = $request->JVPM;
        $profesionalEnMedicina->especialidad_id = $request->especialidad_id;
        $profesionalEnMedicina->trabajador_id = $request->trabajador_id;
        $profesionalEnMedicina->save();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        ProfesionalEnMedicina::destroy($request->id);
    }
}
