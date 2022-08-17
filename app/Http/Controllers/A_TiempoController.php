<?php

namespace App\Http\Controllers;

use App\model\A_Tiempo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class A_TiempoController extends Controller
{
    public function index(){
        $a_tiempo = A_Tiempo::all();

        return view('plantilla',compact('a_tiempo'));
    }

    public function crear(Request $request){        
        $existe = DB::table('a_tiempo')
        ->where('nombre',$request->nombre)
        ->first();
        if(isset($existe)){
            return redirect()->to('/a-tiempo')->with('msj', "Error".$existe->nombre);
        }
        else{
            $a_tiempo = A_Tiempo::create($request->post());
            return redirect()->to('/a-tiempo')->with('msj', "Exito");
        }        
    }

    public function editar(Request $request){
        
        $a_tiempo = DB::table('a_tiempo')
        ->where('id',$request->id);

        $a_tiempo->update($request->all());               
        
        return redirect()->to('/a-tiempo')->with('msj', "Actualizado");
    }

    public function cambiarEstado(Request $request){        
        if($request->cambiar_estado == "activo"){
            $estado = "inactivo";
        }
        else{
            $estado = "activo";
        }
        
        $a_tiempo = DB::table('a_tiempo')
        ->where('id','=',$request->id)
        ->update([
            "estado" => $estado,
        ]);   
        
        return redirect()->to('/a-tiempo');
    }

    public function borrar(Request $request){
        
        $a_tiempo = DB::table('a_tiempo')
        ->where('id','=',$request->id)
        ->delete();   
        
        return redirect()->to('/a-tiempo');
    }
}
