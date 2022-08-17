<?php

namespace App\Http\Controllers;

use App\model\Modalidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModalidadController extends Controller
{
    public function index(){
        $modalidad = Modalidad::all();

        return view('plantilla',compact('sucursal'));
    }

    public function crear(Request $request){        
        $existe = DB::table('modalidad')
        ->where('nombre',$request->nombre)
        ->first();
        if(isset($existe)){
            return redirect()->to('/modalidad')->with('msj', "Error".$existe->nombre);
        }
        else{
            $modalidad = Modalidad::create($request->post());
            return redirect()->to('/modalidad')->with('msj', "Exito");
        }        
    }

    public function editar(Request $request){
        
        $modalidad = DB::table('modalidad')
        ->where('id',$request->id);

        $modalidad->update($request->all());               
        
        return redirect()->to('/modalidad')->with('msj', "Actualizado");
    }

    public function cambiarEstado(Request $request){        
        if($request->cambiar_estado == "activo"){
            $estado = "inactivo";
        }
        else{
            $estado = "activo";
        }
        
        $modalidad = DB::table('modalidad')
        ->where('id','=',$request->id)
        ->update([
            "estado" => $estado,
        ]);   
        
        return redirect()->to('/modalidad');
    }

    public function borrar(Request $request){
        
        $modalidad = DB::table('modalidad')
        ->where('id','=',$request->id)
        ->delete();   
        
        return redirect()->to('/modalidad');
    }
}
