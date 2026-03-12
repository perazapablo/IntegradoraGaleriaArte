<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\GaleriaArteController;
use App\Http\Controllers\AdicionalesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\TiposController;
use App\Http\Controllers\DbUpController;
use App\Http\Controllers\DashBoardController;


/*
 Rutas públicas
............................................
 Aquí están las rutas que no necesitan login
 como login, registro y generación de datos de prueba
*/

// generar clientes de prueba
Route::get('/dbup/clientes', [DbUpController::class, 'Cliente'])->name('dbup.clientes');

// generar órdenes de prueba
Route::get('/dbup/ordenes', [DbUpController::class, 'Crear_Orden'])->name('dbup.ordenes');


// login
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/iniciar_sesion', [LoginController::class, 'iniciar_sesion'])
    ->name('Login.iniciar_sesion');

Route::post('/registro', [LoginController::class, 'registro'])
    ->name('Login.registro');



/*
 Rutas protegidas
 ............................................
 Aquí están las rutas que requieren login
 como el dashboard, productos, roles, etc.
*/

Route::group(['middleware' => 'auth'], function(){

        // ruta base
        Route::get('/', function(){
                return;
        });

        /*
        TIPOS DE OBRA
        ............................................
        */

        Route::get('/tipos', [TiposController::class, 'main'])
            ->name('catalogo_tipos');

        Route::post('/tipos_save', [TiposController::class, 'save'])
            ->name('tipos_save');


        /*
        EXTRAS / ADICIONALES
        ............................................
        */

        Route::get('/adicionales', [AdicionalesController::class, 'main'])
            ->name('catalogo_adicionales');

        Route::get('/adds', [AdicionalesController::class, 'adds'])
            ->name('adicionales');

        Route::post('/adicionales_save', [AdicionalesController::class, 'save'])
            ->name('Adicionales.save');


        /*
        PÁGINA PRINCIPAL DE LA GALERÍA
        ............................................
        */

        Route::get('/home', [GaleriaArteController::class, 'main'])
            ->name('Galeria.home');


        /*
        PRODUCTOS (obras)
        ............................................
        */

        // petición que usa Vue para traer productos
        Route::get('/productos', [GaleriaArteController::class, 'productos'])
            ->name('Galeria.productos');

        // catálogo completo
        Route::get('/catalogo_productos', [GaleriaArteController::class, 'catalogo_productos'])
            ->name('Galeria.catalogo_productos');

        // guardar producto
        Route::post('/productos/save', [GaleriaArteController::class, 'save'])
            ->name('productos.save');


        /*
        ROLES   
        ............................................
        */

        Route::get('/rol', [RolController::class, 'index'])
            ->name('Rol.index');

        Route::post('/rol/save', [RolController::class,'save'])
            ->name('Rol.save');

        /*
        DASHBOARD (migrado del coffee)
        ............................................
        */

        // vista principal del dashboard
        Route::get('/dashboard', [DashBoardController::class, 'index'])
            ->name('dashboard');

        // total de ventas
        Route::get('/dashboard/ventas', [DashBoardController::class, 'total_ventas'])
            ->name('dashboard.ventas');

        // ventas por canal
        Route::get('/dashboard/ventas/canal', [DashBoardController::class, 'total_canal'])
            ->name('dashboard.canal');

        // ventas por categoría (tipos de obra)
        Route::get('/dashboard/ventas/categoria', [DashBoardController::class, 'total_categorias'])
            ->name('dashboard.categoria');

        // ventas por producto
        Route::get('/dashboard/ventas/producto', [DashBoardController::class, 'total_productos'])
            ->name('dashboard.producto');

        // demográficos por género
        Route::match(['get','post'], '/dashboard/demograficos/genero',
            [DashBoardController::class, 'demograficos_genero'])
            ->name('dashboard.demograficos');

});