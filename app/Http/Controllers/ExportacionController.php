<?php

namespace App\Http\Controllers;

use App\Exports\Exportacion;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use \PDF;

class ExportacionController extends Controller
{
    public function excel(Request $request){           
        return Excel::download(new Exportacion($request->nombre,$request->campos), $request->nombre.'.xlsx');
    }

    public function pdf(Request $request){
        
        $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        $fecha = date('d') . " " . $meses[date('n') - 1] . " " . date('Y') . " " . date('H:i:s');
        
        /*$select = "";
        for($i = 0 ; $i < count($request->campos) ; $i++){
            if($i == count($request->campos)-1){
                $select .= "'" . $request->campos[$i] . "'"; 
            }            
            else{
                $select .= "'" . $request->campos[$i] . "',"; 
            }
        }*/

        $consulta = DB::table($request->nombre)
        /*->select($select)*/
        ->get();
        

        $modulo = $request->nombre;
        $campos = $request->campos;
        
        $pdf = PDF::loadView('exports.pdf', compact('consulta', 'fecha', "modulo", 'campos'));
        return $pdf->download($modulo . '.pdf');
    }
}