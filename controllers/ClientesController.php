<?php

namespace Controllers;


use MVC\Router;

class ClientesController {

    public static function index(Router $router){
       
        if(!is_auth()){
            header('Location:/login');
        }
        $router->render('clientes/index', [
            'titulo' => 'Clientes',
            'nombre'=>$_SESSION['nombre']
        
        ]);
    }


  
}