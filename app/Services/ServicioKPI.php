<?php

namespace App\Services;

use App\Models\Productos;
use App\Models\Orden;
use App\Models\DetalleOrden;
use App\Models\ExtraOrden;
use Illuminate\Support\Facades\DB;

////Key Performance Indicator
class ServicioKPI

/* Consulta base 
select SUM(orden.total)
from orden
where fecha>=DATE_SUB(NOW(), INTERVAL 3 MONTH)
order by fecha desc*/
{
    function total_ventas($objeto){//la logica se hace varias veces
        if(!isset($objeto->tendencias)){
           $objeto->tendencias=false;
        }

        /////1-Definir la consulta base
        $consulta = DB::table('orden')
           ->select(
                DB::raw("SUM(orden.total) as total") 
        )
        ->whereRaw("fecha>=DATE_SUB(NOW(), INTERVAL 3 MONTH)");

        /////2.Configurar la consulta base
        if($objeto->tendencias){
            $consulta->addSelect(DB::raw("DATE_FORMAT(orden.fecha,'%m-%Y') as fecha"))
            ->groupBy(DB::raw("DATE_FORMAT(orden.fecha, '%m-%Y')"))
            ->orderByRaw("DATE_FORMAT(orden.fecha, '%m-%Y')");
        }

        /////3.Obtener la informacion
        return $consulta->get();
    }

        /*Consulta base
        select orden.canal
        ,SUM(orden.total) as total
        from orden
        where orden.fecha>=DATE_SUB(now(),INTERVAL 3 MONTH)
        group by orden.canal
        order by SUM(orden.total)*/

        function total_ventas_canal($objeto){
            if(!isset($objeto->tendencias)){
               $objeto->tendencias=false;
            }

             /////1-Definir la consulta base
            $consulta = DB::table('orden')
            ->select(
                    DB::raw("SUM(orden.total) as total"),
                    "orden.canal"
            )
            ->whereRaw("fecha>=DATE_SUB(NOW(), INTERVAL 3 MONTH)")
            ->groupBy("orden.canal")
            ->orderByRaw("SUM(orden.total)");

            /////2.Configurar la consulta base
            if($objeto->tendencias){
                $consulta->addSelect(DB::raw("DATE_FORMAT(orden.fecha,'%m-%Y') as fecha"))
                ->groupBy(DB::raw("DATE_FORMAT(orden.fecha, '%m-%Y')"))
                ->orderByRaw("DATE_FORMAT(orden.fecha, '%m-%Y')");
            }

            return $consulta->get();
        } 


        /*consulta base
        select tipos.nombre
             ,SUM(detalle_orden.precio*detalle_orden.cantidad) as total
            from orden
            join detalle_orden on detalle_orden.idorden=orden.id
            join productos on detalle_orden.idproducto=productos.id
            join tipos on productos.idtipo=tipos.id
            where orden.fecha>=DATE_SUB(now(),INTERVAL 3 MONTH)
            group by tipos.id
            order by SUM(detalle_orden.precio*detalle_orden.cantidad)
         */

        function total_ventas_categoria($objeto){

              if(!isset($objeto->idcategoria)){
                 $objeto->idcategoria=0;

               $consulta = DB::table('orden')
                             ->join('detalle_orden','detalle_orden.idorden','=','orden.id')
                             ->join('productos','detalle_orden.idproducto','=','productos.id')
                             ->join('tipos','productos.idtipo','=','tipos.id')
                             ->whereRaw("orden.fecha>=DATE_SUB(NOW(), INTERVAL 3 MONTH)")
                            // Nota: se agrego tipos.nombre al GROUP BY porque MariaDB con ONLY_FULL_GROUP_BY
           // exige que todas las columnas del SELECT que no son agregadas esten en GROUP BY.
                             ->groupBy("tipos.id","tipos.nombre")
                             ->select(
                                "tipos.nombre",
                                "tipos.id",
                                DB::raw("SUM(detalle_orden.precio*detalle_orden.cantidad) as total")
                             )
                             ->orderByRaw("SUM(detalle_orden.precio*detalle_orden.cantidad)");

              //pregunto si la categoria es distinta de 0 con el !=0 
              if($objeto->idcategoria!=0){

                $consulta->addSelect(DB::raw("DATE_FORMAT(orden.fecha,'%m-%Y') as fecha"))
                         ->groupBy(DB::raw("DATE_FORMAT(orden.fecha, '%m-%Y')"))
                         ->where("tipos.id",$objeto->idcategoria)
                         ->orderByRaw("DATE_FORMAT(orden.fecha, '%m-%Y')");
              }        

              return $consulta->get();               
            }
        }

        /*consulta base
        select productos.nombre
             ,SUM(detalle_orden.precio*detalle_orden.cantidad) as total
            from orden
            join detalle_orden on detalle_orden.idorden=orden.id
            join productos on detalle_orden.idproducto=productos.id
            where orden.fecha>=DATE_SUB(now(),INTERVAL 3 MONTH)
            group by productos.id
            order by SUM(detalle_orden.precio*detalle_orden.cantidad)
         */

        function total_ventas_producto($objeto){

              if(!isset($objeto->idproducto)){
                 $objeto->idproducto=0;

               $consulta = DB::table('orden')
                             ->join('detalle_orden','detalle_orden.idorden','=','orden.id')
                             ->join('productos','detalle_orden.idproducto','=','productos.id')
                             ->whereRaw("orden.fecha>=DATE_SUB(NOW(), INTERVAL 3 MONTH)")
                             ->groupBy("productos.id")
                             ->select(
                                "productos.nombre",
                                DB::raw("SUM(detalle_orden.precio*detalle_orden.cantidad) as total")
                             )
                             ->orderByRaw("SUM(detalle_orden.precio*detalle_orden.cantidad)");

              //pregunto si el producto es distinta de 0 con el !=0 
              if($objeto->idproducto!=0){

                $consulta->addSelect(DB::raw("DATE_FORMAT(orden.fecha,'%m-%Y') as fecha"))
                         ->groupBy(DB::raw("DATE_FORMAT(orden.fecha, '%m-%Y')"))
                         ->where("productos.id",$objeto->idproducto)
                         ->orderByRaw("DATE_FORMAT(orden.fecha, '%m-%Y')");
              }        

              return $consulta->get();               
            }
        }



        /*consulta base
        select genero.nombre
               ,COUNT(*) as total
        from cliente
        join genero on cliente.idgenero = genero.id
        group by genero.nombre
        */

        function demograficos_genero($objeto){

            if(!isset($objeto->idedad))
                $objeto->idedad=0;

            if(!isset($objeto->idocupacion))
                $objeto->idocupacion=0;

            $consulta=DB::table('cliente')
                ->join('genero','cliente.idgenero','=','genero.id')
                ->select(
                    'genero.nombre as genero',
                    DB::raw("COUNT(*) as total")
                )
                ->groupBy('genero.nombre');

            if($objeto->idedad!=0){
                $consulta->where('cliente.idedad',$objeto->idedad);
            }

            if($objeto->idocupacion!=0){
                $consulta->where('cliente.idocupacion',$objeto->idocupacion);
            }

            return $consulta->get();
        }

}

////////////////////////////video 25 de febrero Miercoles////
/////////////////////// me quede en el min 59:18, de ahi solo explico dashboards  ////////////

?>