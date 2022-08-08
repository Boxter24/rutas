<?php

namespace App\Http\Controllers;

use App\Exports\Exportacion;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use \PDF;

class ExportacionController extends Controller
{
    public function excel(Request $request){   
        //dd($request);
        return Excel::download(new Exportacion($request->nombre,$request->campos), $request->nombre.'.xlsx');
    }

    public function pdf(Request $request){
        
        $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        $fecha = date('d') . " " . $meses[date('n') - 1] . " " . date('Y') . " " . date('H:i:s');

        $rutas = DB::table('rutas')
        ->get();

        $modulo = "Rutas";

        $pdf = PDF::loadView('pdfs.rutas', compact('rutas', 'fecha', "modulo"));
        return $pdf->download($modulo . '.pdf');
    }
}