<?php

namespace Model;

class  Proveedor extends ActiveRecord {
    protected static $tabla = 'proveedores';
    protected static $columnasDB = ['id', 'nombre','celular', 'direccion'];

    public $id;
    public $nombre;
    public $celular;
    public $direccion;

 
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->celular = $args['celular'] ?? '';
        $this->direccion = $args['direccion'] ?? '';

      
    }


}