<?php

namespace App\Http\Controllers;

use App\model\Moneda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonedaController extends Controller
{
    public function index(){
        $moneda = Moneda::all();

        return view('plantilla',compact('moneda'));
    }

    public function crear(Request $request){        
        $existe = DB::table('moneda')
        ->where('nombre',$request->nombre)
        ->first();
        if(isset($existe)){
            return redirect()->to('/moneda')->with('msj', "Error".$existe->nombre);
        }
        else{
            $moneda = Moneda::create($request->post());
            return redirect()->to('/moneda')->with('msj', "Exito");
        }        
    }

    public function editar(Request $request){
        
        $moneda = DB::table('moneda')
        ->where('id',$request->id);

        $moneda->update($request->all());               
        
        return redirect()->to('/moneda')->with('msj', "Actualizado");
    }

    public function cambiarEstado(Request $request){        
        if($request->cambiar_estado == "activo"){
            $estado = "inactivo";
        }
        else{
            $estado = "activo";
        }
        
        $moneda = DB::table('moneda')
        ->where('id','=',$request->id)
        ->update([
            "estado" => $estado,
        ]);   
        
        return redirect()->to('/moneda');
    }

    public function borrar(Request $request){
        
        $moneda = DB::table('moneda')
        ->where('id','=',$request->id)
        ->delete();   
        
        return redirect()->to('/moneda');
    }
}
