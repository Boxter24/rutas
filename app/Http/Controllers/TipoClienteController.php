<?php

namespace App\Http\Controllers;

use App\model\TipoCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoClienteController extends Controller
{
    public function index(){
        $tipo_cliente = TipoCliente::all();

        return view('plantilla',compact('tipo_cliente'));
    }

    public function crear(Request $request){        
        $existe = DB::table('tipo_cliente')
        ->where('nombre',$request->nombre)
        ->first();
        if(isset($existe)){
            return redirect()->to('/tipo-cliente')->with('msj', "Error".$existe->nombre);
        }
        else{
            $tipo_cliente = TipoCliente::create($request->post());
            return redirect()->to('/tipo-cliente')->with('msj', "Exito");
        }        
    }

    public function editar(Request $request){
        
        $tipo_cliente = DB::table('tipo_cliente')
        ->where('id',$request->id);

        $tipo_cliente->update($request->all());               
        
        return redirect()->to('/tipo-cliente')->with('msj', "Actualizado");
    }

    public function cambiarEstado(Request $request){        
        if($request->cambiar_estado == "activo"){
            $estado = "inactivo";
        }
        else{
            $estado = "activo";
        }
        
        $tipo_cliente = DB::table('tipo_cliente')
        ->where('id','=',$request->id)
        ->update([
            "estado" => $estado,
        ]);   
        
        return redirect()->to('/tipo-cliente');
    }

    public function borrar(Request $request){
        
        $tipo_cliente = DB::table('tipo_cliente')
        ->where('id','=',$request->id)
        ->delete();   
        
        return redirect()->to('/tipo-cliente');
    }
}
