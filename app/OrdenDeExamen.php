<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenDeExamen extends Model
{
    protected $table= 'orden_de_examen';
    protected $fallable =['reusltadoEscaneado','razonDeLaOrden', 'examen_id', 'consulta_id'];
    public function examen(){
        return $this->belongsTo('App\Examen', 'examen_id');
    }
    public function consulta(){
        return $this->belongsTo('App\Consulta', 'consulta_id');
    }
}
