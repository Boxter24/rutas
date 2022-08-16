<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class UnidadesDeNegocios extends Model
{   
    public $timestamps = false;
    
    protected $fillable = [
        'nombre_unidad_de_negocios','estado',
    ];
}
