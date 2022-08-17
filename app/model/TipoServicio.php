<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class TipoServicio extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'nombre','estado',
    ];
}
