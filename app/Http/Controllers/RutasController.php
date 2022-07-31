<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\model\Rutas;

class RutasController extends Controller
{
    public function borrar(Request $request){
        //dd($request->id);
        $rutas = DB::table('rutas')
        ->where('id','=',$request->id)
        ->delete();   
        
        return redirect()->to('/home');
    }

    public function crear(Request $request){
        //dd($request);
        $ruta = Rutas::create($request->post());

        return redirect()->to('/home');
    }

    public function editar(Request $request){
        //dd($request);
        $ruta = DB::table('rutas')
            ->where('id',$request->id);

        $ruta->update($request->all()); 
        
        return redirect()->to('/home');
    }
}
