<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InversoController extends Controller
{
    public function inverso(){
        return view('invertir');
    }
}
