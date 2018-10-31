<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table= 'persona';
    protected $fillable = ['nombre','apellidos', 'fechaDeNacimiento', 'documentoDeIdentidad', 'estadoCivil','genero', 'direccion_id', 'clinica_id'];
    public function direccion(){
        return $this->belongsTo('App\Direccion', 'direccion_id');
    }
    public function clinica(){
        return $this->belongsTo('App\Clinica', 'clinica_id');
    }
    public function user(){
        return $this->hasOne('App\User');
    }
}
