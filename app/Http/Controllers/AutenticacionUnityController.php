<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

use App\Models\Usuarios;

class AutenticacionUnityController extends Controller
{
    function login(Request $r){
        Log::info($r->all());

    $usuario=Usuarios::where("email", $r->email)->first();
        if($usuario){
            return response()->json([
                "success" => true,
                "message" => "Usuario encontrado"
            ]);
        }
        else{
            return response()->json([
                "success"=>false,
                "message"=> "Usuario no encontrado"
            ]);
        }
        

    }
     public function register(Request $request)
    {
        Log::info($request->all());
        $usuario_exitoso=Usuarios::create([
            'idrol'=> 2,
            'email'    => $request->email,
            'password' => bcrypt($request->password)
        ]);

        if($usuario_exitoso){
            return response()->json([
                    'success' => true,
                    'mensaje' => 'Usuario registrado exitosamente'
                ]);
        }
        else{
      return response()->json([
                    'success' => true,
                    'mensaje' => 'ERROR AL REGISTRAR USUARIO!!'
                ]);
        }   
       
    }
}
