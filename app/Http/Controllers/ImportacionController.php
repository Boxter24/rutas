<?php

namespace App\Http\Controllers;

use App\Imports\RutasImport;
use App\model\Rutas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportacionController extends Controller
{
    public function excel(Request $request){                
        if($request->hasFile('documento')){
            $file = $request->file('documento');                        
            $rutas = Excel::import(new RutasImport, $file);                                 
        }
        return redirect()->to('/home')->with('msj', "Exito");
    }
    
}
