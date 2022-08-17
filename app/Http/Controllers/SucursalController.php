<?php

namespace App\Http\Controllers;

use App\model\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SucursalController extends Controller
{
    public function index(){
        $sucursal = Sucursal::all();

        return view('plantilla',compact('sucursal'));
    }

    public function crear(Request $request){        
        $existe = DB::table('sucursal')
        ->where('nombre',$request->nombre)
        ->first();
        if(isset($existe)){
            return redirect()->to('/sucursal')->with('msj', "Error".$existe->nombre);
        }
        else{
            $sucursal = Sucursal::create($request->post());
            return redirect()->to('/sucursal')->with('msj', "Exito");
        }        
    }

    public function editar(Request $request){
        
        $sucursal = DB::table('sucursal')
        ->where('id',$request->id);

        $sucursal->update($request->all());               
        
        return redirect()->to('/sucursal')->with('msj', "Actualizado");
    }

    public function cambiarEstado(Request $request){        
        if($request->cambiar_estado == "activo"){
            $estado = "inactivo";
        }
        else{
            $estado = "activo";
        }
        
        $sucursal = DB::table('sucursal')
        ->where('id','=',$request->id)
        ->update([
            "estado" => $estado,
        ]);   
        
        return redirect()->to('/sucursal');
    }

    public function borrar(Request $request){
        
        $sucursal = DB::table('sucursal')
        ->where('id','=',$request->id)
        ->delete();   
        
        return redirect()->to('/sucursal');
    }
}
