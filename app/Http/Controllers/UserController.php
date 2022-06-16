<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function borrar(Request $request){
        //dd($request->id);
        $usuarios = DB::table('users')
        ->where('id','=',$request->id)
        ->delete();   
        
        return redirect()->to('/home');
    }

    public function crear(Request $request){
        //dd($request);
        $usuarios = DB::table('users')
        ->insertGetId([
            'name' => $request->name,
            'identificacion' => $request->identificacion,
            'email' => $request->email,
            'direccion' => $request->direccion,
            'password' => Hash::make($request->contrasena), 
        ]);
        return redirect()->to('/home');
    }

    public function editar(Request $request){
        //dd($request);
        $usuarios = DB::table('users')
        ->where('id', $request->id)
        ->update([
            'name' => $request->name,
            'identificacion' => $request->identificacion,
            'email' => $request->email,
            'direccion' => $request->direccion,
            'password' => Hash::make($request->contrasena),
        ]);  
        
        return redirect()->to('/home');
    }
}
