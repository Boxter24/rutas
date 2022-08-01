<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Rutas extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'nombre_ruta', 'km_ruta','dias_ruta','estado_ruta',
    ];
}
