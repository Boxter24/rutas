<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Completadas extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'nombre','estado',
    ];
}
