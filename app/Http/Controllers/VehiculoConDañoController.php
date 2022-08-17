<?php

namespace App\Http\Controllers;

use App\model\VehiculoConDaño;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehiculoConDañoController extends Controller
{
    public function index(){
        $vehiculo_con_daño = VehiculoConDaño::all();

        return view('plantilla',compact('vehiculo_con_daño'));
    }

    public function crear(Request $request){        
        $existe = DB::table('vehiculo_con_daño')
        ->where('nombre',$request->nombre)
        ->first();
        
        if(isset($existe)){
            return redirect()->to('/vehiculo-con-daño')->with('msj', "Error".$existe->nombre);
        }
        else{
            $vehiculo_con_daño = VehiculoConDaño::create($request->post());
            return redirect()->to('/vehiculo-con-daño')->with('msj', "Exito");
        }        
    }

    public function editar(Request $request){
        
        $vehiculo_con_daño = DB::table('vehiculo_con_daño')
        ->where('id',$request->id);

        $vehiculo_con_daño->update($request->all());               
        
        return redirect()->to('/vehiculo-con-daño')->with('msj', "Actualizado");
    }

    public function cambiarEstado(Request $request){        
        if($request->cambiar_estado == "activo"){
            $estado = "inactivo";
        }
        else{
            $estado = "activo";
        }
        
        $vehiculo_con_daño = DB::table('vehiculo_con_daño')
        ->where('id','=',$request->id)
        ->update([
            "estado" => $estado,
        ]);   
        
        return redirect()->to('/vehiculo-con-daño');
    }

    public function borrar(Request $request){
        
        $vehiculo_con_daño = DB::table('vehiculo_con_daño')
        ->where('id','=',$request->id)
        ->delete();   
        
        return redirect()->to('/vehiculo-con-daño');
    }
}
