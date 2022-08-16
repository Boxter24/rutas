<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Vehiculos extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'nombre_vehiculo', 'ideales_vehiculo', 'estado_vehiculo',
    ];
}
