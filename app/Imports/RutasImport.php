<?php

namespace App\Imports;

use App\model\Rutas;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;

class RutasImport implements ToModel
{   
    public function model(array $row)
    {   $existe = DB::table('rutas')
            ->where('nombre_ruta',$row[0])
            ->first();
        //dd($existe);
        if(!isset($existe)){
            return new Rutas([            
                "nombre_ruta" => $row[0],
                "km_ruta"     => $row[1],
                "dias_ruta"   => $row[2],
            ]);
        }        
    }
}
