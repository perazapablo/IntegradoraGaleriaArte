<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ServicioKPI;
use App\Models\Tipos;
use App\Models\Edad;
use App\Models\Ocupaciones;

class DashBoardController extends Controller{

    function index(){
        $datos=array();
        $datos['canales']=array('WEB','APP','KIOSKO','TIENDA');
        $datos['categorias']=Tipos::all();
        $datos['edades']=Edad::all();
        $datos['ocupaciones']=Ocupaciones::all();
        return view('dashboard.index')->with($datos);

    }


    function total_ventas(){
        $servicio=new ServicioKPI();
        $x=new \StdClass();
        $info=$servicio->total_ventas($x);
        //dd($info);
        $y=new \StdClass();
        $y->tendencias=true;
        $info2=$servicio->total_ventas($y);
        //dd($info2);

        $resultado=new \StdClass();
        $resultado->total=$info[0]->total;
        $resultado->tendencias=$info2;
        return response()->json($resultado);

    }

    function total_categorias(){ 

        $servicio=new ServicioKPI();
        $x=new \StdClass(); 
        $info=$servicio->total_ventas_categoria($x); // Devuelve las ventas agrupadas por categoría
        //dd($info);
        //dd($info[count($info)-1]);
        $y=new \StdClass(); // Se crea otro objeto para aplicar un filtro específico
        $y->idcategoria=2; // Se define la categoría que se usará para obtener tendencias
        $info2=$servicio->total_ventas_categoria($y); // Consulta las tendencias de esa categoría
        //dd($info2);
        $resultado=new \StdClass(); // Objeto que almacenará la respuesta final del dashboard
        if(count($info)>0){ //verifica que la consulta tenga resultados para evitar el error "Undefined array key"
            $resultado->top=$info[0]; // Primera categoría según el orden de la consulta
            $resultado->bottom=$info[count($info)-1]; // Última categoría según el orden de la consulta
        }else{
            $resultado->top=null; // Si no hay datos se devuelve null para evitar errores en Vue
            $resultado->bottom=null; // También se devuelve null para mantener la estructura del JSON
        }

        $resultado->categorias=$info; // Lista completa de categorías con su total de ventas
        $resultado->tendencias=$info2; // Tendencias de la categoría seleccionada

        return response()->json($resultado); // Se envía el resultado al dashboard en formato JSON
    }

    function total_canal(){
        $servicio=new ServicioKPI();
        $x=new \StdClass();
        $info=$servicio->total_ventas_canal($x);
        //dd($info);
        $y=new \StdClass();
        $y->tendencias=true;
        $info2=$servicio->total_ventas_canal($y);
        //dd($info2);
        $resultado=new \StdClass();
        $resultado->canales=$info;
        $resultado->tendencias=$info2;

        return response()->json($resultado);
    }

    function total_productos(Request $r){
        $context=$r->all();
        $servicio=new ServicioKPI();
        $x=new \StdClass();
        $info=$servicio->total_ventas_producto($x);
        //dd($info);
        //dd($info[count($info)-1]);
        $y=new \StdClass();
        // Si viene idproducto por POST, usarlo, sino usar el valor por defecto
        $y->idproducto = isset($context['idproducto']) ? $context['idproducto'] : 4;
        $info2=$servicio->total_ventas_producto($y);
        //dd($info2);
        $resultado=new \StdClass();
        if(count($info)>0){
            $resultado->top=$info[0];
            $resultado->bottom=$info[count($info)-1];
        }else{
            $resultado->top=null;
            $resultado->bottom=null;
        }
        $resultado->productos=$info;
        $resultado->tendencias=$info2;

        return response()->json($resultado);
////////////////////video 26 de febrero youtube//////////
                                         
    }
    function demograficos_genero(Request $r){
        $context=$r->all();
        ///dd($context)
        $servicio=new ServicioKPI();
        $x=new \StdClass();
        if(isset($context['idedad'])){
            $x->idedad=$context['idedad'];
        }
        if(isset($context['idocupacion'])){
            $x->idocupacion=$context['idocupacion'];
        }
        $resultado=new \StdClass();
        $resultado=$servicio->demograficos_genero($x);
        //dd($info);
        return response()->json($resultado);
    }

}
////////////////////video 2 tutos drive//////////