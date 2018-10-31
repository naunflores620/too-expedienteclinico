<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TratamientoMedico extends Model
{
    protected $table = 'tratamientos_medicos';
    protected $fillable = ['tratamiento_medico', 'descripcion'];
}
