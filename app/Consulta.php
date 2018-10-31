<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $fillable = ['sintomatologia', 'diagnostico', 'profesional_en_medicina_id', 'paciente_id'];
    public function profesional_medico(){
        return $this->belongsTo('App\ProfesionalEnMedicina', 'profesional_en_medicina_id');
    }
    public function paciente(){
        return $this->belongsTo('App\Paciente', 'paciente_id');
    }
}
