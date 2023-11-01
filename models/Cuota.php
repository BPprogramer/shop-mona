<?php

namespace Model;

class  Cuota extends ActiveRecord {
    protected static $tabla = 'pago_cuotas';
    protected static $columnasDB = ['id', 'monto', 'saldo','fecha_pago', 'caja_id'];


    public $id;
    public $monto;
    public $saldo;
    public $fecha_pago;
    public $caja_id;
 

 
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->monto = $args['monto'] ?? '';
        $this->saldo = $args['saldo'] ?? '';
        $this->fecha_pago = $args['fecha_pago'] ?? '';
        $this->caja_id = $args['caja_id'] ?? '';
    
    }


}