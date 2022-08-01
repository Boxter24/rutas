<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\model\Rutas;

class RutasController extends Controller
{
    public function borrar(Request $request){
        //dd($request->id);
        $rutas = DB::table('rutas')
        ->where('id','=',$request->id)
        ->delete();   
        
        return redirect()->to('/home');
    }

    public function crear(Request $request){
        //dd($request->post());
        /*try {
            $ruta = Rutas::create($request->post());
        } catch (Exception $e) {
            return redirect()->to('/home')->with('msj', "Error");
        }*/
        $existe = DB::table('rutas')
        ->where('nombre_ruta',$request->nombre_ruta)
        ->first();
        if(isset($existe)){
            return redirect()->to('/home')->with('msj', "Error")->with('msj', "Error".$existe->nombre_ruta);
        }
        else{
            $ruta = Rutas::create($request->post());
            return redirect()->to('/home')->with('msj', "Exito");
        }        
    }

    public function editar(Request $request){
        //dd($request);
        $existe = DB::table('rutas')
        ->where('nombre_ruta',$request->nombre_ruta)
        ->first();
        
        if(isset($existe)){
            return redirect()->to('/home')->with('msj', "Error".$existe->nombre_ruta);
        }
        else{
            $ruta = DB::table('rutas')
            ->where('id',$request->id);

            $ruta->update($request->all());
        }          
        
        return redirect()->to('/home')->with('msj', "Actualizado");
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
        $rutas = DB::table('rutas')
        ->where('id','=',$request->id)
        ->update([
            "estado_ruta" => $estado,
        ]);   
        
        return redirect()->to('/home');
    }
}
