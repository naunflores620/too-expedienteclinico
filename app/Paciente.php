<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = ['numero_de_expediente', 'profesion', 'oficio', 'nombre_del_padre', 'nombre_de_la_madre', 'nombre_de_conyugue', 'persona_id'];
    public function persona(){
        return $this->belongsTo('App\Persona', 'persona_id');
    }
}
