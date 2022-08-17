<?php

namespace App\Http\Controllers;

use App\model\Desconsolidador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DesconsolidadorController extends Controller
{
    public function index(){
        $desconsolidador = Desconsolidador::all();

        return view('plantilla',compact('desconsolidador'));
    }

    public function crear(Request $request){        
        $existe = DB::table('desconsolidador')
        ->where('nombre',$request->nombre)
        ->first();
        if(isset($existe)){
            return redirect()->to('/desconsolidador')->with('msj', "Error".$existe->nombre);
        }
        else{
            $desconsolidador = Desconsolidador::create($request->post());
            return redirect()->to('/desconsolidador')->with('msj', "Exito");
        }        
    }

    public function editar(Request $request){
        
        $desconsolidador = DB::table('desconsolidador')
        ->where('id',$request->id);

        $desconsolidador->update($request->all());               
        
        return redirect()->to('/desconsolidador')->with('msj', "Actualizado");
    }

    public function cambiarEstado(Request $request){        
        if($request->cambiar_estado == "activo"){
            $estado = "inactivo";
        }
        else{
            $estado = "activo";
        }
        
        $a_tiempo = DB::table('desconsolidador')
        ->where('id','=',$request->id)
        ->update([
            "estado" => $estado,
        ]);   
        
        return redirect()->to('/desconsolidador');
    }

    public function borrar(Request $request){
        
        $desconsolidador = DB::table('desconsolidador')
        ->where('id','=',$request->id)
        ->delete();   
        
        return redirect()->to('/desconsolidador');
    }
}
