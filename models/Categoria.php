<?php

namespace Model;

class Categoria extends ActiveRecord {
    protected static $tabla = 'categorias';
    protected static $columnasDB = ['id', 'categoria'];

    public $id;
    public $categoria;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->categoria = $args['categoria'] ?? '';

    }

}