<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Receta;

class RecetaController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio =$request->criterio;

        if($buscar==''){
       
            $receta =Receta::join('', 'consultas.profesional_en_medicina_id',  '=' , 'profesionales_en_medicina.id')
            -> join('pacientes', 'consultas.paciente_id' , '=', 'pacientes.id')
            ->select('consultas.id', 'consultas.sintomatologia', 'consultas.diagnostico', 'consultas.profesional_en_medicina_id', 'consultas.paciente_id')
            ->orderBy('consultas.id', 'desc')->get(); 
return $consulta;
        }
        else{
            $receta= Examen::where($criterio,'like', '%' . $buscar . '%')-> orderBy('id','desc')->paginate(2);

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
    
   
    public function store(Request $request)
    {
        $examen = new Examen();
        $examen->nombre = $request->nombre;
        $examen->descripcion = $request->descripcion;
        $examen->save();
       
    }

    public function update(Request $request)
    {
        $examen = Examen::findOrFail($request->id);
        $examen->nombre = $request->nombre;
        $examen->descripcion = $request->descripcion;
        $examen->save();
    }
}
