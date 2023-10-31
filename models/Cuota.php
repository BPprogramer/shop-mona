<?php

namespace Model;

class  PagoCuota extends ActiveRecord {
    protected static $tabla = 'pago_cuotas';
    protected static $columnasDB = ['id', 'monto','fecha_pago', 'caja_id'];


    public $id;
    public $monto;
    public $fecha_pago;
    public $caja_id;
 

 
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->monto = $args['monto'] ?? '';
        $this->fecha_pago = $args['fecha_pago'] ?? '';
        $this->caja_id = $args['caja_id'] ?? '';
       

      
    }


}