<?php

namespace Model;

class  Egreso extends ActiveRecord {
    protected static $tabla = 'egresos';
    protected static $columnasDB = ['id', 'egreso','descripcion', 'fecha', 'estado', 'caja_id', 'usuario_id'];

    public $id;
    public $egreso;
    public $descripcion;
    public $fecha;
    public $estado;
    public $caja_id;
    public $usuario_id;


 
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->egreso = $args['egreso'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';

        $this->fecha = $args['fecha'] ?? '';
        $this->estado = $args['estado'] ?? '';
     
        $this->caja_id = $args['caja_id'] ?? '';
        $this->usuario_id = $args['usuario_id'] ?? '';

    }
    public function formatearDatosFloat(){
      
        $this->egreso = floatval(str_replace(',','',$this->egreso));
  
     
     
    }


}