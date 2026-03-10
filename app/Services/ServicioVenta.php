<?php
namespace App\Services;
use App\Models\Orden;
use App\Models\DetalleOrden;
use App\Models\ExtraOrden;

class ServicioVenta{

    function guardar_orden($datos){

        $orden = new Orden();
        $orden->fecha = $datos->fecha;
        $orden->total=0;
        $orden->idcliente=$datos->idcliente;
        $orden->subtotal=0;
        $orden->idforma_pago=$datos->idforma_pago??1;
        $orden->canal= $datos->canal;
        $orden->idcanal= $datos->idcanal;
        $orden->idvendedor=$datos->idvendedor ?? 0;
        $orden->idstatus=$datos->idstatus ?? 0;

        $orden->save();

        $subtotal=0;
        $total=0;
        $iva=0.16;
        $num_productos=0;

        foreach($datos->productos as $producto){

            $detalle_orden= new DetalleOrden();
            $detalle_orden->idorden=$orden->id;
            $detalle_orden->idproducto=$producto['id'];
            $detalle_orden->cantidad=$producto['cantidad']?? 1;
            $num_productos+=$detalle_orden->cantidad;
            $detalle_orden->precio=$producto['precio'];
            $subtotal=$subtotal+($detalle_orden->precio*$detalle_orden->cantidad);
            $detalle_orden->iddescuento=null;
            $detalle_orden->idtamanio=$producto['tamanio'];
            $detalle_orden->save();

            foreach($producto['adicionales'] as $extra){
                $extra_orden = new ExtraOrden();
                $extra_orden->idextra=$extra['id'];
                $extra_orden->iddetalle_orden=$detalle_orden->id;
                $extra_orden->nom_extra=$extra['nombre'];
                $extra_orden->cantidad=$extra['cantidad'] ?? 1;
                $extra_orden->precio=$extra['precio'];
                $subtotal+=$extra_orden->precio*$extra_orden->cantidad;
                $extra_orden->idtipo=$extra['idtipo'];
                $extra_orden->save();
            }

        }

        $orden->subtotal=$subtotal;
        $total_iva=round($subtotal*$iva,2);
        $orden->total=$subtotal+$total_iva;
        $orden->numero_productos=$num_productos;
        $orden->save();

        return 'Ordenes creadas correctamente';
    }
}
