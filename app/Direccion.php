<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table = 'direcciones';
    protected $fillable = ['casa', 'calle', 'colonia', 'municipio_id'];
    public function municipio(){
        return $this->belongsTo('App\Municipio', 'municipio_id');
    }
}
