<?php

namespace Controllers;


use MVC\Router;

class ProveedoresController {

    public static function index(Router $router){
        session_start();
        if(!is_auth()){
            header('Location:/login');
        }
        $router->render('proveedores/index', [
            'titulo' => 'Proveedores',
            'nombre'=>$_SESSION['nombre']
        
        ]);
    }

}