<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class VehiculoConDaño extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'nombre','estado',
    ];
}
