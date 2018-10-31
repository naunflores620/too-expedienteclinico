<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SignoVital extends Model
{
    protected $table = 'signos_vitales';
    protected $fillable = ['nombre','unidadDeMedida'];
}
