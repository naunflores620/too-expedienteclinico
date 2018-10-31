<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HorarioAsignacionPuesto extends Model
{
    protected $table = 'horarios_de_asignacion_de_puesto';
    protected $fillable = ['horario_id', 'asignacion_puesto_id'];
    public function horario(){
        return $this->belongsTo('App\Horario', 'horario_id');
    }
    public function asignacion_puesto(){
        return $this->belongsTo('App\AsignacionPuesto', 'asignacion_puesto_id');
    }
}
