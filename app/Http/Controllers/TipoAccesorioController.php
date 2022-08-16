<?php

namespace App\Http\Controllers;

use App\model\TipoAccesorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoAccesorioController extends Controller
{
    public function index(){

        $datos = TipoAccesorio::all();

        $modulo = ['singular' => "Tipo Accesorio",'nombre' => "tipo_accesorio"];            

        $campos = ['Nombre Tipo Accesorio','Estado Tipo Accesorio','Opciones'];

        $data = ['nombre'];
                       
        return view('plantilla',compact('datos','modulo','campos','data'));
    }

    public function crear(Request $request){   
        
        $existe = DB::table('tipo_accesorio')
        ->where('nombre',$request->nombre)
        ->first();

        if(isset($existe)){
            return redirect()->to('/tipo-accesorio')->with('msj', "Error".$existe->nombre);
        }
        else{                                                
            $carga = Cargas::create($request->post());
            return redirect()->to('/tipo-accesorio')->with('msj', "Exito");
        }        
    }

    public function editar(Request $request){   
             
        $carga = DB::table('tipo_accesorio')
        ->where('id',$request->id);

        $carga->update($request->all());           
        
        return redirect()->to('/tipo-accesorio')->with('msj', "Actualizado");
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
        $rutas = DB::table('tipo_accesorio')
        ->where('id','=',$request->id)
        ->update([
            "estado" => $estado,
        ]);   
        
        return redirect()->to('/tipo-accesorio');
    }

    public function borrar(Request $request){
        
        $carga = DB::table('tipo_accesorio')
        ->where('id','=',$request->id)
        ->delete();   
        
        return redirect()->to('/tipo-accesorio');
    }
}
