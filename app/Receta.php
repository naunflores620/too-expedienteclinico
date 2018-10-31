<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    protected $fillable = ['indicaciones', 'cantidad', 'consulta_id', 'medicamento_id'];
    public function consulta(){
        return $this->belongsTo('App\Consulta', 'consulta_id');
    }
    public function medicamento(){
        return $this->belongsTo('App\Medicamento', 'medicamento_id');
    }
}
