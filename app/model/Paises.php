<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Paises extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'nombre_pais','nombre_pais_abreviado', 'codigo_telefonico', 'estado_pais'
    ];
}
