<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HorarioAsignacionPuesto;
use App\AsignacionPuesto;
use App\Horario;
use App\Trabajador;

class HorarioAsignacionPuestoController extends Controller
{
    private $clinica=1;
    public function index(Request $request)
    {
        $horarioClinica =HorarioAsignacionPuesto::join('asignacion_puesto','horarios_de_asignacion_de_puesto.asignacion_puesto_id', '=', 'asignacion_puesto.id')
        ->join('trabajadores','asignacion_puesto.trabajador_id', '=', 'trabajadores.id')
        ->join('puestos','asignacion_puesto.puesto_id','=','puestos.id')
        ->join('persona', function($join)
        {
            $join->on('trabajadores.persona_id', '=', 'persona.id')
                 ->where('persona.clinica_id', '=', $this->clinica);
        })
        ->join('horario','horarios_de_asignacion_de_puesto.horario_id', '=' , 'horario.id')
        ->select('horario.dia','horario.desde','horario.hasta','persona.nombre','horario.id','puestos.puesto','asignacion_puesto.id as ap_id')
        ->orderBy('horario.dia','desc')->get();
        return $horarioClinica; 
    }
    
    public function store(Request $request)
    {
        $horario = Horario::orderBy('id','desc')->value('id');
        
        $horarioClinica= new HorarioAsignacionPuesto();
        $horarioClinica->horario_id= $horario;
        $horarioClinica->asignacion_puesto_id= $request->puesto;
        $horarioClinica->save();
       
    }
}
