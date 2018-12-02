<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfesionalEnMedicina extends Model
{
    protected $table = 'profesionales_en_medicina';
    protected $fillable = ['JVPM', 'trabajador_id', 'especialidad_id'];
   
    public function trabajador(){
        return $this->belongsTo('App\Trabajador');
    }
    public function especialidad(){
        return $this->belongsTo('App\Especialidad');
    }

   /* public function ofertaservicio(){
        return $this->belongsTo('App\OfertaDeServicio', 'oferta_de_servicio_id');
    }*/
}
