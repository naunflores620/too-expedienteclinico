<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table= 'servicio';
    protected $fillable = ['nombre','apellidos', 'especialidad_id'];
    public function especialidad(){
        return $this->belongsTo('App\Especialidad', 'especialidad_id');
    }
}
