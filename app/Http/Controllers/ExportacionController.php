<?php

namespace App\Http\Controllers;

use App\Exports\Exportacion;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportacionController extends Controller
{
    public function excel(Request $request){   
        //dd($request);
        return Excel::download(new Exportacion($request->nombre,$request->campos), $request->nombre.'.xlsx');
    }
}