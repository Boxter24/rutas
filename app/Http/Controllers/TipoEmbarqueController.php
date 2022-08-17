<?php

namespace App\Http\Controllers;

use App\model\TipoEmbarque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoEmbarqueController extends Controller
{
    public function index(){
        $tipo_embarque = TipoEmbarque::all();

        return view('plantilla',compact('tipo_embarque'));
    }

    public function crear(Request $request){        
        $existe = DB::table('tipo_embarque')
        ->where('nombre',$request->nombre)
        ->first();
        if(isset($existe)){
            return redirect()->to('/tipo-embarque')->with('msj', "Error".$existe->nombre);
        }
        else{
            $tipo_embarque = TipoEmbarque::create($request->post());
            return redirect()->to('/tipo-embarque')->with('msj', "Exito");
        }        
    }

    public function editar(Request $request){
        
        $tipo_embarque = DB::table('tipo_embarque')
        ->where('id',$request->id);

        $tipo_embarque->update($request->all());               
        
        return redirect()->to('/tipo-embarque')->with('msj', "Actualizado");
    }

    public function cambiarEstado(Request $request){        
        if($request->cambiar_estado == "activo"){
            $estado = "inactivo";
        }
        else{
            $estado = "activo";
        }
        
        $a_tiempo = DB::table('tipo_embarque')
        ->where('id','=',$request->id)
        ->update([
            "estado" => $estado,
        ]);   
        
        return redirect()->to('/tipo-operacion');
    }

    public function borrar(Request $request){
        
        $tipo_embarque = DB::table('tipo_embarque')
        ->where('id','=',$request->id)
        ->delete();   
        
        return redirect()->to('/tipo-embarque');
    }
}
