<?php

namespace App\Http\Controllers;

use App\model\Planificada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanificadaController extends Controller
{
    public function index(){
        $planificada = Planificada::all();

        return view('plantilla',compact('planificada'));
    }

    public function crear(Request $request){        
        $existe = DB::table('planificada')
        ->where('nombre',$request->nombre)
        ->first();
        
        if(isset($existe)){
            return redirect()->to('/planificada')->with('msj', "Error".$existe->nombre);
        }
        else{
            $planificada = Planificada::create($request->post());
            return redirect()->to('/planificada')->with('msj', "Exito");
        }        
    }

    public function editar(Request $request){
        
        $planificada = DB::table('planificada')
        ->where('id',$request->id);

        $planificada->update($request->all());               
        
        return redirect()->to('/planificada')->with('msj', "Actualizado");
    }

    public function cambiarEstado(Request $request){        
        if($request->cambiar_estado == "activo"){
            $estado = "inactivo";
        }
        else{
            $estado = "activo";
        }
        
        $planificada = DB::table('planificada')
        ->where('id','=',$request->id)
        ->update([
            "estado" => $estado,
        ]);   
        
        return redirect()->to('/planificada');
    }

    public function borrar(Request $request){
        
        $planificada = DB::table('planificada')
        ->where('id','=',$request->id)
        ->delete();   
        
        return redirect()->to('/planificada');
    }
}
