<?php

namespace App\Http\Controllers;

use App\model\TipoServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoServicioController extends Controller
{
    public function index(){
        $tipo_servicio = TipoServicio::all();

        return view('plantilla',compact('tipoServicio'));
    }

    public function crear(Request $request){        
        $existe = DB::table('tipo_servicio')
        ->where('nombre',$request->nombre)
        ->first();
        
        if(isset($existe)){
            return redirect()->to('/tipo-servicio')->with('msj', "Error".$existe->nombre);
        }
        else{
            $tipo_servicio = TipoServicio::create($request->post());
            return redirect()->to('/tipo-servicio')->with('msj', "Exito");
        }        
    }

    public function editar(Request $request){
        
        $tipo_servicio = DB::table('tipo_servicio')
        ->where('id',$request->id);

        $tipo_servicio->update($request->all());               
        
        return redirect()->to('/tipo-servicio')->with('msj', "Actualizado");
    }

    public function cambiarEstado(Request $request){        
        if($request->cambiar_estado == "activo"){
            $estado = "inactivo";
        }
        else{
            $estado = "activo";
        }
        
        $tipo_servicio = DB::table('tipo_servicio')
        ->where('id','=',$request->id)
        ->update([
            "estado" => $estado,
        ]);   
        
        return redirect()->to('/tipo-servicio');
    }

    public function borrar(Request $request){
        
        $tipo_servicio = DB::table('tipo_servicio')
        ->where('id','=',$request->id)
        ->delete();   
        
        return redirect()->to('/tipo-servicio');
    }
}
