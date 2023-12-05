<?php 

namespace Controllers;

use Model\Caja;
use Model\Cuota;
use Model\Venta;
use Model\Cliente;
use Model\Producto;



class ApiInicio{
    public static function index(){
        if(!is_admin()){
            echo json_encode(['type'=>'error', 'msg'=>'Hubo un error, porfavor intente nuevamente']);
            return;
        }
   
        $info = [];
        $ingresos = Venta::total('total');
        if($ingresos){
            $info['ingresos'] = $ingresos['total'];
        }else{
            $info['ingresos'] = 0;
        }
        $costos = Venta::total('costo');
        if($costos){
            $info['costos'] = $costos['total'];
        }else{
            $info['costos'] = 0;
        }

         $info['ganancias'] = $ingresos['total'] - $costos['total'];

         $inventario = Producto::total('stock*precio_compra');
         if($inventario){
             $info['inventario'] = $inventario['total'];
         }else{
             $info['inventario'] = 0;
         }

        $ingresos_reales = Venta::total('recaudo');
        if($ingresos_reales){
            $info['ingresos_reales'] = $ingresos_reales['total'];
        }else{
            $info['ingresos_reales'] = 0;
        }
        $mercado_libre = Venta::whereArray(['metodo_pago'=>3]);
        $dinero_mercado_libre = 0;
        $dinero_pendiente_mercado_libre = 0;
        if($mercado_libre){
            foreach($mercado_libre as $venta){
                if($venta->estado==1){
                    $dinero_mercado_libre = $dinero_mercado_libre+$venta->recaudo;
                }else{
                    $dinero_pendiente_mercado_libre = $dinero_pendiente_mercado_libre+$venta->total;
                }
            }
            $info['dinero_mercado_libre'] = $dinero_mercado_libre;
            $info['dinero_pendiente_mercado_libre'] = $dinero_pendiente_mercado_libre;
           
        }else{
            $info['dinero_mercado_libre'] = 0;
            $info['dinero_pendiente_mercado_libre'] = 0;
        }

        $info['ganancias_reales'] = $info['ingresos_reales'] -  $info['costos'];
        $info['fiados'] = $info['ingresos'] -  $info['ingresos_reales'];

        $numero_ventas = Venta::contar('estado',1);
        $numero_fiados = Venta::contar('estado',0);
        $numero_pagos = Cuota::contar();
        $numero_cajas = Caja::contar();
        $numero_productos = Producto::contar();
        $numero_clientes  = Cliente::contar();

 

        $informacion = [
            'ingresos'=>'$'.number_format($info['ingresos']),
            'costos'=>'$'.number_format($info['costos']),
            'ganancias'=>'$'.number_format($info['ganancias']),
            'inventario'=>'$'.number_format($info['inventario']),
            'ingresos_reales'=>'$'.number_format($info['ingresos_reales']),
            'ganancias_reales'=>'$'.number_format($info['ganancias_reales']),
            'fiados'=>'$'.number_format($info['fiados']),
            'numero_ventas'=>number_format($numero_ventas['total']),
            'numero_fiados'=>number_format($numero_fiados['total']),
            'numero_pagos'=>number_format($numero_pagos['total']),
            'numero_cajas'=>number_format($numero_cajas['total']),
            'numero_productos'=>number_format($numero_productos['total']),
            'numero_clientes'=>number_format($numero_clientes['total']),
            'dinero_mercado_libre'=>number_format($info['dinero_mercado_libre']),
            'dinero_pendiente_mercado_libre'=>number_format($info['dinero_pendiente_mercado_libre'])
       
            

        ];

   



        


        

        
  
         echo json_encode($informacion);
    


    }
}