<?php

namespace Model;

class  Ingreso extends ActiveRecord {
    protected static $tabla = 'ingresos';
    protected static $columnasDB = ['id', 'ingreso','descripcion', 'fecha', 'estado', 'caja_id', 'usuario_id'];

    public $id;
    public $ingreso;
    public $descripcion;
    public $fecha;
    public $estado;
    public $caja_id;
    public $usuario_id;


 
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->ingreso = $args['ingreso'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';

        $this->fecha = $args['fecha'] ?? '';
        $this->estado = $args['estado'] ?? '';
     
        $this->caja_id = $args['caja_id'] ?? '';
        $this->usuario_id = $args['usuario_id'] ?? '';

    }
    public function formatearDatosFloat(){
      
        $this->ingreso = floatval(str_replace(',','',$this->ingreso));
  
     
     
    }


}