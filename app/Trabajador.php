<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    protected $table = 'trabajadores';
    protected $fillable = ['nit', 'nup'];
    public function persona(){
        return $this->belongsTo('App\Persona', 'persona_id');
    }

    public function profesionalEnMedicina(){
        return $this->hasMany('App\ProfesionalEnMedicina');
    }
}
