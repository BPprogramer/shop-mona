<?php

namespace Model;

class   Cliente extends ActiveRecord {
    protected static $tabla = 'clientes';
    protected static $columnasDB = ['id', 'nombre', 'cedula', 'celular', 'direccion', 'email'];

    public $id;
    public $nombre;
    public $cedula;
    public $celular;
    public $direccion;
    public $email;
   

    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->cedula = $args['cedula'] ?? '';
        $this->celular = $args['celular'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
        $this->email = $args['email'] ?? '';
      
    }

    // Validar el Login de Usuarios
    // public function validarLogin() {
    //     if(!$this->email) {
    //         self::$alertas['error'][] = 'El Email del Usuario es Obligatorio';
    //     }
    //     if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
    //         self::$alertas['error'][] = 'Email no válido';
    //     }
    //     if(!$this->password) {
    //         self::$alertas['error'][] = 'El Password no puede ir vacio';
    //     }
    //     return self::$alertas;

    // }

    // Validación para cuentas nuevas
    public function validar_cuenta() {
        // if(!$this->nombre) {
        //     self::$alertas['error'][] = 'El Nombre es Obligatorio';
        // }
     
        // if(!$this->email) {
        //     self::$alertas['error'][] = 'El Email es Obligatorio';
        // }
        // if(!$this->password) {
        //     self::$alertas['error'][] = 'El Password no puede ir vacio';
        // }
        // if(strlen($this->password) < 6) {
        //     self::$alertas['error'][] = 'El password debe contener al menos 6 caracteres';
        // }
    
        // return self::$alertas;
    }

    // Valida un email
    public function validarEmail() {
        // if(!$this->email) {
        //     self::$alertas['error'][] = 'El Email es Obligatorio';
        // }
        // if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
        //     self::$alertas['error'][] = 'Email no válido';
        // }
        // return self::$alertas;
    }

   
   

   

   
}