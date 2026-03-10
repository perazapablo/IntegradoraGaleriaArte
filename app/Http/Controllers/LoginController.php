<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Models\Usuarios;
use App\Models\Clientes;
use App\Models\Generos;
use App\Models\Ocupaciones;
use App\Models\Edad;

class LoginController extends Controller
{
    function login(){
        $edades= Edad::all();
        $ocupaciones= Ocupaciones::all();
        $generos=Generos::all();

        return view('Login.login', compact('edades','generos','ocupaciones'));
    }

    public function iniciar_sesion(Request $r){
        $credenciales=$r->all();
        $context = $r -> validate(
            ['email' => ['required', 'email'],
            'password' => ['required']],
        );
        if(Auth::attempt(['email' => $context['email'], 'password' => $context['password']])){
            $r -> session()-> regenerate() ;
            $user = Auth::user();

            if($user -> idrol == 3){
                return redirect() -> route('Galeria.home');
            }
            else{
                return redirect()-> back() -> withError('Email o contraseña incorrectos!', 'error');
            }
        }
        else{
            return redirect()-> back() -> withError('Email o contraseña incorrectos!', 'error');
        }
    }

    function registro(Request $r){

        $r->validate([
            'email'      => ['required', 'email'],
            'password'   => ['required'],
            'nombre'     => ['required'],
            'idgenero'   => ['required'],
            'idocupacion'=> ['required'],
            'idedad'     => ['required'],
        ]);

        $usuario_existe = Usuarios::where('email', $r->email)->first();
        if($usuario_existe){
            return redirect()->back()->with('error', 'Usuario ya registrado');
        }

        $nuevo_usuario = Usuarios::create([
            'idrol'    => 3,
            'email'    => $r->email,
            'password' => bcrypt($r->password),
        ]);

        $nuevo_cliente = Clientes::create([
            'nombre'      => $r->nombre,
            'email'       => $r->email,
            'idedad'      => $r->idedad,
            'idusuario'   => $nuevo_usuario->id,
            'idgenero'    => $r->idgenero,
            'idocupacion' => $r->idocupacion,
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
