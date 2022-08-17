<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Planificada extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'nombre','estado',
    ];
}
