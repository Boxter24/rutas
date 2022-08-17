<?php

namespace App\Http\Controllers;

use App\model\Completadas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompletadasController extends Controller
{
    public function index(){
        $completadas = Completadas::all();

        return view('plantilla',compact('completadas'));
    }

    public function crear(Request $request){        
        $existe = DB::table('completadas')
        ->where('nombre',$request->nombre)
        ->first();
        
        if(isset($existe)){
            return redirect()->to('/completadas')->with('msj', "Error".$existe->nombre);
        }
        else{
            $completadas = Completadas::create($request->post());
            return redirect()->to('/completadas')->with('msj', "Exito");
        }        
    }

    public function editar(Request $request){
        
        $completadas = DB::table('completadas')
        ->where('id',$request->id);

        $completadas->update($request->all());               
        
        return redirect()->to('/completadas')->with('msj', "Actualizado");
    }

    public function cambiarEstado(Request $request){        
        if($request->cambiar_estado == "activo"){
            $estado = "inactivo";
        }
        else{
            $estado = "activo";
        }
        
        $completadas = DB::table('completadas')
        ->where('id','=',$request->id)
        ->update([
            "estado" => $estado,
        ]);   
        
        return redirect()->to('/completadas');
    }

    public function borrar(Request $request){
        
        $completadas = DB::table('completadas')
        ->where('id','=',$request->id)
        ->delete();   
        
        return redirect()->to('/completadas');
    }
}
