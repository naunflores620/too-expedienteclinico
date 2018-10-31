<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HorarioDeClinica extends Model
{
    protected $table = 'horarios_de_clinica';
    protected $fillable = ['clinica_id', 'horario_id'];
    public function clinica(){
        return $this->belongsTo('App\Clinica', 'clinica_id');
    }
    public function horario(){
        return $this->belongsTo('App\Horario', 'horario_id');
    }

}
