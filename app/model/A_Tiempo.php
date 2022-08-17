<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class A_Tiempo extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'nombre','estado',
    ];
}
