<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class TipoAccesorio extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'nombre', 'estado',
    ];
}
