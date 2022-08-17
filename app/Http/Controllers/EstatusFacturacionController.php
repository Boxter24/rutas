<?php

namespace App\Http\Controllers;

use App\model\EstatusFacturacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstatusFacturacionController extends Controller
{
    public function index(){
        $estatus_facturacion = EstatusFacturacion::all();

        return view('plantilla',compact('estatus_facturacion'));
    }

    public function crear(Request $request){        
        $existe = DB::table('estatus_facturacion')
        ->where('nombre',$request->nombre)
        ->first();
        if(isset($existe)){
            return redirect()->to('/estatus-facturacion')->with('msj', "Error".$existe->nombre);
        }
        else{
            $estatus_facturacion = EstatusFacturacion::create($request->post());
            return redirect()->to('/estatus-facturacion')->with('msj', "Exito");
        }        
    }

    public function editar(Request $request){
        
        $estatus_facturacion = DB::table('estatus_facturacion')
        ->where('id',$request->id);

        $estatus_facturacion->update($request->all());               
        
        return redirect()->to('/estatus-facturacion')->with('msj', "Actualizado");
    }

    public function cambiarEstado(Request $request){        
        if($request->cambiar_estado == "activo"){
            $estado = "inactivo";
        }
        else{
            $estado = "activo";
        }
        
        $estatus_facturacion = DB::table('estatus_facturacion')
        ->where('id','=',$request->id)
        ->update([
            "estado" => $estado,
        ]);   
        
        return redirect()->to('/estatus-facturacion');
    }

    public function borrar(Request $request){
        
        $estatus_facturacion = DB::table('estatus_facturacion')
        ->where('id','=',$request->id)
        ->delete();   
        
        return redirect()->to('/estatus-facturacion');
    }
}
