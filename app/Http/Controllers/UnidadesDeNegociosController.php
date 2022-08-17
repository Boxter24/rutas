<?php

namespace App\Http\Controllers;

use App\model\UnidadesDeNegocios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnidadesDeNegociosController extends Controller
{    
    public function index(){
        $unidades_de_negocios = UnidadesDeNegocios::all();

        return view('unidades_de_negocios',compact('unidades_de_negocios'));
    }

    public function crear(Request $request){        
        $existe = DB::table('unidades_de_negocios')
        ->where('nombre_unidad_de_negocios',$request->nombre_unidad_de_negocios)
        ->first();
        if(isset($existe)){
            return redirect()->to('/unidades-de-negocios')->with('msj', "Error".$existe->nombre_unidad_de_negocios);
        }
        else{
            $unidad_de_negocios = UnidadesDeNegocios::create($request->post());
            return redirect()->to('/unidades-de-negocios')->with('msj', "Exito");
        }        
    }

    public function editar(Request $request){
        
        $unidad_de_negocios = DB::table('unidades_de_negocios')
        ->where('id',$request->id);

        $unidad_de_negocios->update($request->all());               
        
        return redirect()->to('/unidades-de-negocios')->with('msj', "Actualizado");
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
        $unidad_de_negocios = DB::table('unidades_de_negocios')
        ->where('id','=',$request->id)
        ->update([
            "estado" => $estado,
        ]);   
        
        return redirect()->to('/unidades-de-negocios');
    }

    public function borrar(Request $request){
        
        $unidad_de_negocios = DB::table('unidades_de_negocios')
        ->where('id','=',$request->id)
        ->delete();   
        
        return redirect()->to('/unidades-de-negocios');
    }
}
