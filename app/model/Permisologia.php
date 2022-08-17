<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Permisologia extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'nombre','estado',
    ];
}
