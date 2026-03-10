<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\GaleriaArteController;
use App\Http\Controllers\AdicionalesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\TiposController;




        
      
        Route::get('/login', [LoginController::class, 'login']) -> name('login');
        Route::get('/logout', [LoginController::class, 'logout']) -> name('logout');
        Route::post('/iniciar_sesion', [LoginController::class, 'iniciar_sesion'])->name('Login.iniciar_sesion');
        Route::post('/registro', [LoginController::class, 'registro'])->name('Login.registro');
        
        
Route::group(['middleware' => 'auth'], function(){
        Route::get('/', function(){
                return;
        });

        Route::get('/tipos', [TiposController::class, 'main']) -> name('catalogo_tipos');
        Route::post('/tipos_save', [TiposController::class, 'save']) -> name('tipos_save');


        Route::get('/adicionales', [AdicionalesController::class, 'main']) -> name('catalogo_adicionales');
        Route::get('/adds', [AdicionalesController::class, 'adds']) -> name('adicionales');
        Route::post('/adicionales_save', [AdicionalesController::class, 'save']) -> name('Adicionales.save');


        Route::get('/home', [GaleriaArteController::class, 'main']) -> name('Galeria.home');

        //peticion
        Route::get('/productos', [GaleriaArteController::class, 'productos']) -> name('Galeria.productos');
        Route::get('/catalogo_productos', [GaleriaArteController::class, 'catalogo_productos'])->name('Galeria.catalogo_productos');        
        Route::post('/productos/save', [GaleriaArteController::class, 'save'])->name('productos.save');  
        
        //ROLES
        Route::get('/rol', [RolController::class, 'index'])-> name('Rol.index');
        Route::post('/rol/save', [RolController::class,'save'])->name('Rol.save');

        
});



