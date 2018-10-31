<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TomaDeSignoVital extends Model
{
    protected $table= 'toma_de_signo_vital';
    protected $fallable =['valor', 'signo_vital_id', 'consulta_id'];
    public function signovital(){
        return $this->belongsTo('App\signoVital', 'signo_vital_id');
    }
    public function consulta(){
        return $this->belongsTo('App\Consulta', 'consulta_id');
    }
}
