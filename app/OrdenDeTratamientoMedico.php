<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenDeTratamientoMedico extends Model
{
    protected $table = 'ordenes_de_tratamiento_medico';
    protected $fillable = ['indicaciones', 'razon_del_tratamiento', 'consulta_id', 'tratamiento_medico_id'];
    public function consulta(){
        return $this->belongsTo('App\Consulta', 'consulta_id');
    }
    public function tratamiento_medico(){
        return $this->belongsTo('App\TratamientoMedico', 'tratamiento_medico_id');
    }
}
