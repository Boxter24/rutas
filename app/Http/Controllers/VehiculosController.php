<?php

namespace App\Http\Controllers;

use App\model\Vehiculos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehiculosController extends Controller
{
    public function index(){

        $vehiculos = Vehiculos::all();

        return view('tipo_vehiculo',compact('vehiculos'));
    }

    public function crear(Request $request){   
             
        $existe = DB::table('vehiculos')
        ->where('nombre_vehiculo',$request->nombre_pais)
        ->first();

        if(isset($existe)){
            return redirect()->to('/vehiculos')->with('msj', "Error".$existe->nombre_vehiculo);
        }
        else{                                                
            $ruta = Vehiculos::create($request->post());
            return redirect()->to('/vehiculos')->with('msj', "Exito");
        }        
    }

    public function editar(Request $request){   
             
        $vehiculo = DB::table('vehiculos')
        ->where('id',$request->id);

        $vehiculo->update($request->all());           
        
        return redirect()->to('/vehiculos')->with('msj', "Actualizado");
    }

    public function cambiarEstado(Request $request){
        //dd($request);
        if($request->cambiar_estado == "activo"){
            $estado = "inactivo";
        }
        else{
            $estado = "activo";
        }
        //dd($estado);
        $rutas = DB::table('vehiculos')
        ->where('id','=',$request->id)
        ->update([
            "estado_vehiculo" => $estado,
        ]);   
        
        return redirect()->to('/vehiculos');
    }

    public function borrar(Request $request){
        
        $pais = DB::table('vehiculos')
        ->where('id','=',$request->id)
        ->delete();   
        
        return redirect()->to('/vehiculos');
    }
}
