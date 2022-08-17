<?php

namespace App\Http\Controllers;

use App\model\Permisologia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermisologiaController extends Controller
{
    public function index(){
        $permisologia = Permisologia::all();

        return view('plantilla',compact('permisologia'));
    }

    public function crear(Request $request){        
        $existe = DB::table('permisologia')
        ->where('nombre',$request->nombre)
        ->first();
        
        if(isset($existe)){
            return redirect()->to('/permisologia')->with('msj', "Error".$existe->nombre);
        }
        else{
            $permisologia = Permisologia::create($request->post());
            return redirect()->to('/permisologia')->with('msj', "Exito");
        }        
    }

    public function editar(Request $request){
        
        $permisologia = DB::table('permisologia')
        ->where('id',$request->id);

        $permisologia->update($request->all());               
        
        return redirect()->to('/permisologia')->with('msj', "Actualizado");
    }

    public function cambiarEstado(Request $request){        
        if($request->cambiar_estado == "activo"){
            $estado = "inactivo";
        }
        else{
            $estado = "activo";
        }
        
        $permisologia = DB::table('permisologia')
        ->where('id','=',$request->id)
        ->update([
            "estado" => $estado,
        ]);   
        
        return redirect()->to('/permisologia');
    }

    public function borrar(Request $request){
        
        $permisologia = DB::table('permisologia')
        ->where('id','=',$request->id)
        ->delete();   
        
        return redirect()->to('/permisologia');
    }
}
