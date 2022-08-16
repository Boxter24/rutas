<?php

namespace App\Http\Controllers;

use App\model\Cargas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CargasController extends Controller
{
    public function index(){

        $datos = Cargas::all();

        $modulo = ['singular' => "Carga",'nombre' => "carga"];            

        $campos = ['Nombre Carga','Estado Carga','Opciones'];

        $data = ['nombre'];
                       
        return view('plantilla',compact('datos','modulo','campos','data'));
    }

    public function crear(Request $request){   
        
        $existe = DB::table('cargas')
        ->where('nombre',$request->nombre)
        ->first();

        if(isset($existe)){
            return redirect()->to('/carga')->with('msj', "Error".$existe->nombre);
        }
        else{                                                
            $carga = Cargas::create($request->post());
            return redirect()->to('/carga')->with('msj', "Exito");
        }        
    }

    public function editar(Request $request){   
             
        $carga = DB::table('carga')
        ->where('id',$request->id);

        $carga->update($request->all());           
        
        return redirect()->to('/carga')->with('msj', "Actualizado");
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
        $rutas = DB::table('cargas')
        ->where('id','=',$request->id)
        ->update([
            "estado" => $estado,
        ]);   
        
        return redirect()->to('/carga');
    }

    public function borrar(Request $request){
        
        $carga = DB::table('cargas')
        ->where('id','=',$request->id)
        ->delete();   
        
        return redirect()->to('/carga');
    }
}
