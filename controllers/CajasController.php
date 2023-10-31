<?php

namespace Controllers;


use MVC\Router;

class CajasController {

    public static function index(Router $router){
        if(!is_auth()){
            header('Location:/login');
        }
        
        $router->render('cajas/index', [
            'titulo' => 'Cajas',
            'nombre'=>$_SESSION['nombre']
        
        ]);
    }

}