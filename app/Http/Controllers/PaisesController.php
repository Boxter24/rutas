<?php

namespace App\Http\Controllers;

use App\model\Paises;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaisesController extends Controller
{
    public function index(){
        $paises = Paises::all();

        return view('paises',compact('paises'));
    }

    public function crear(Request $request){   
             
        $existe = DB::table('paises')
        ->where('nombre_pais',$request->nombre_pais)
        ->first();
        if(isset($existe)){
            return redirect()->to('/paises')->with('msj', "Error".$existe->nombre_pais);
        }
        else{
            $separacion = explode(' ',$request->nombre_pais);
            $primeraLetra = "";
            $nombre_abreviado = "";

            for($i = 0 ; $i < count($separacion) ; $i++){
                $primeraLetra = $separacion[$i];                
                $nombre_abreviado .= $primeraLetra[0];
            }
            
            $request->merge(['nombre_pais_abreviado' => $nombre_abreviado]);
            
            $ruta = Paises::create($request->post());
            return redirect()->to('/paises')->with('msj', "Exito");
        }        
    }

    public function editar(Request $request){   
             
        $pais = DB::table('paises')
        ->where('id',$request->id);

        $pais->update($request->all());           
        
        return redirect()->to('/paises')->with('msj', "Actualizado");
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
        $rutas = DB::table('paises')
        ->where('id','=',$request->id)
        ->update([
            "estado_pais" => $estado,
        ]);   
        
        return redirect()->to('/paises');
    }

    public function borrar(Request $request){
        
        $pais = DB::table('paises')
        ->where('id','=',$request->id)
        ->delete();   
        
        return redirect()->to('/paises');
    }
}
