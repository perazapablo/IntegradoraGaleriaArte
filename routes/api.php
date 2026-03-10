<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GaleriaArteController;
use App\Http\Controllers\UnityObrasController;
use App\Http\Controllers\AutenticacionUnityController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::post('/venta/save', [VentaController::class, 'RecibirVenta'])->name('venta_save');  
Route::get('/obra/{target}',[UnityObrasController::class,'show'])->name('show');
Route::post('/obra/comprar',[UnityObrasController::class,'comprar'])->name('comprar');

//API LOGIN
Route::post('/login_api/',[AutenticacionUnityController::class,'login'])->name('login_api');
Route::post('/register_api/',[AutenticacionUnityController::class,'register'])->name('register_api');