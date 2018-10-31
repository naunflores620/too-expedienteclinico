<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsignacionPuesto extends Model
{
    protected $table = 'asignacion_puesto';
    protected $fillable = ['salario', 'trabajador_id','puesto_id'];
    public function trabajador(){
        return $this->belongsTo('App\Trabajador', "trabajador_id");
    }
    public function puesto(){
        return $this->belongsTo('App\Puesto', "puesto_id");
    }

}
