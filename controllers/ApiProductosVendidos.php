<?php

namespace Controllers;

use DateTime;
use Model\Producto;
use Model\Venta;
use Model\ProductosVenta;

class ApiProductosVendidos
{
    public static function productosVendidos()
    {

        $fecha_inicial = $_GET['fecha-inicial'];
        $fecha_final = $_GET['fecha-final'];

        $fecha_inicial_dt = new DateTime($fecha_inicial);
        $fecha_final_dt = new DateTime($fecha_final);

        $productos_ventas = ProductosVenta::all();
        $productos_vendidos = [];
        foreach ($productos_ventas as $producto) {
            $venta = Venta::find($producto->venta_id);
            $fecha = explode(" ", $venta->fecha);


            $fecha_dt = new DateTime($fecha[0]);

            if ($fecha_dt >= $fecha_inicial_dt && $fecha_dt <= $fecha_final_dt) {
                $producto->fecha  =  $fecha[0];
                $productos_vendidos[] =  $producto;
            }
        }


        $i = 0;
        $datoJson = '{
         "data": [';
        foreach ($productos_vendidos as $producto) {
            $i++;

            $info_producto = Producto::find($producto->producto_id);


            $datoJson .= '[
                        "' . $i . '",
                        "' . $info_producto->codigo . '",
                        "' . $info_producto->nombre . '",
                      
                      
                        "' . $producto->cantidad . '",
                        "' . number_format($producto->precio) . '",
                        "' . number_format($producto->precio*$producto->cantidad ) . '",
                        "' . $producto->fecha . '"
                 ]';
            if ($i != count($productos_vendidos)) {
                $datoJson .= ",";
            }
        }




        $datoJson .=  ']}';
        echo $datoJson;
    }
}
