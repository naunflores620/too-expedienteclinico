<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = 'especialidades';
    protected $fillable = ['especialidad'];

    public function servicio(){
        return $this->hasMany('App\Servicio');
    }

    public function profesionalEnMedicina(){
        return $this->hasMany('App\ProfesionalEnMedicina');
    }
}
