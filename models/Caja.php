<?php

namespace Model;

class   Caja extends ActiveRecord {
    protected static $tabla = 'cajas';
    protected static $columnasDB = ['id', 'efectivo_apertura', 'recaudo_ventas','pagos_cuotas', 'pagos_creditos', 'ingresos', 'egresos', 'efectivo_cierre','estado', 'fecha_apertura', 'fecha_cierre', 'numero_transacciones', 'vendedor_id'];

    public $id;
    public $efectivo_apertura;
    public $recaudo_ventas;
    public $pagos_cuotas;
    public $pagos_creditos;
    public $ingresos;
    public $egresos;
    public $efectivo_cierre;
    public $estado;
    public $fecha_apertura;
    public $fecha_cierre;
    public $numero_transacciones;
    public $vendedor_id;
 
 

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->efectivo_apertura = $args['efectivo_apertura'] ??0;
        $this->recaudo_ventas = $args['recaudo_ventas'] ?? 0;
        $this->pagos_cuotas = $args['pagos_cuotas'] ?? 0;
        $this->pagos_creditos = $args['pagos_creditos'] ?? 0;
        $this->ingresos = $args['ingresos'] ?? 0;
        $this->egresos = $args['egresos'] ?? 0;
        $this->efectivo_cierre = $args['efectivo_cierre'] ?? 0;
        $this->estado = $args['estado'] ?? 0;
        $this->fecha_apertura = $args['fecha_apertura'] ?? '';
        $this->fecha_cierre = $args['fecha_cierre'] ?? null;
        $this->numero_transacciones= $args['fnumero_transacciones'] ?? 0;
        $this->vendedor_id = $args['vendedor_id'] ?? '';


      
    }
    public function formatearDatosFloat(){
      
        $this->efectivo_apertura = floatval(str_replace(',','',$this->efectivo_apertura));
        $this->recaudo_ventas = floatval(str_replace(',','',$this->recaudo_ventas));
        $this->pagos_cuotas = floatval(str_replace(',','',$this->pagos_cuotas));
        $this->pagos_creditos = floatval(str_replace(',','',$this->pagos_creditos));
        $this->ingresos = floatval(str_replace(',','',$this->ingresos));
        $this->egresos = floatval(str_replace(',','',$this->egresos));
        $this->efectivo_cierre = floatval(str_replace(',','',$this->efectivo_cierre));
     
     
    }


   
}