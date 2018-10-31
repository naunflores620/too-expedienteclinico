<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfertaDeServicio extends Model
{
    protected $fillable = ['precio', 'imagen_url', 'servicio_id', 'clinica_id'];
    public function servicio(){
        return $this->belongsTo('App\Servicio', 'servicio_id');
    }
    public function clinica(){
        return $this->belongsTo('App\Clinica', 'clinica_id');
    }
}
