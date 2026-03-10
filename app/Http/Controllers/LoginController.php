<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Models\Usuarios;

class LoginController extends Controller
{
    function login(){
        return view('Login.login');
    }
    
    public function iniciar_sesion(Request $r){
        $credenciales=$r->all();
        // dd($credenciales);
        //Se valida que los datos que vienen del formulario cumplan con el formato solicitado. 
        $context = $r -> validate(
            ['email' => ['required', 'email'], //required = el campo no puede estar vacio, email= el campo debe tener la sintaxis de un email (@ y dominio ej. @dominio.com)
            'password' => ['required']], //de igual forma, el campo de password no puede estar vacio
        );
        //Validacion de que las credenciales 
        if(Auth::attempt(['email' => $context['email'], 'password' => $context['password']])){
            $r -> session()-> regenerate() ;
            $user = Auth::user();
            
            //Referencia al id de rol usuario en la base de datos
            if($user -> idrol == 2){
                return redirect() -> route('Galeria.home');
            }
        }        
        else{
            return redirect()-> back() -> withError('Email o contraseña incorrectos!', 'error');
        }
        //Redireccion de acuerdo al ro;     
}

    function registro(Request $r){
        
        $credenciales=$r->all();
        $validar=$r->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        $usuario_existe=Usuarios::where('email',$r->email)->first();
        if($usuario_existe){
            return redirect()->back()->withError('Usuario registrado','error');
        }
        $nuevo_usuario=Usuarios::create([
            'idrol'=> 2,
            'email'=>$r->email,
            'password'=>bcrypt($r->password),
        ]);
        Auth::login($nuevo_usuario);
        $r->session()->regenerate();
        return redirect()->route('Galeria.home');

    }
    function logout()
    {
        Auth::logout();     
        Session::flush();     
        return redirect()->route('login'); 
    }   


}