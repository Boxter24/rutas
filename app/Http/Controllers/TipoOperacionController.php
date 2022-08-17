<?php

namespace App\Http\Controllers;

use App\model\TipoOperacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoOperacionController extends Controller
{
    public function index(){
        $tipo_operacion = TipoOperacion::all();

        return view('plantilla',compact('tipo_operacion'));
    }

    public function crear(Request $request){        
        $existe = DB::table('tipo_operacion')
        ->where('nombre',$request->nombre)
        ->first();
        if(isset($existe)){
            return redirect()->to('/tipo-operacion')->with('msj', "Error".$existe->nombre);
        }
        else{
            $tipo_operacion = TipoOperacion::create($request->post());
            return redirect()->to('/tipo-operacion')->with('msj', "Exito");
        }        
    }

    public function editar(Request $request){
        
        $tipo_operacion = DB::table('tipo_operacion')
        ->where('id',$request->id);

        $tipo_operacion->update($request->all());               
        
        return redirect()->to('/tipo-operacion')->with('msj', "Actualizado");
    }

    public function cambiarEstado(Request $request){        
        if($request->cambiar_estado == "activo"){
            $estado = "inactivo";
        }
        else{
            $estado = "activo";
        }
        
        $a_tiempo = DB::table('tipo_operacion')
        ->where('id','=',$request->id)
        ->update([
            "estado" => $estado,
        ]);   
        
        return redirect()->to('/tipo-operacion');
    }

    public function borrar(Request $request){
        
        $tipo_operacion = DB::table('tipo_operacion')
        ->where('id','=',$request->id)
        ->delete();   
        
        return redirect()->to('/tipo-operacion');
    }
}
