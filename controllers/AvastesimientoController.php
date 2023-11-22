<?php

namespace Controllers;


use MVC\Router;

class AvastesimientoController {

    public static function index(Router $router){
        
        if(!is_auth()){
            header('Location:/login');
        }
        
        $router->render('productos/avastesimiento', [
            'titulo' => 'avastesimiento',
            'nombre'=>$_SESSION['nombre']
        
        ]);
    }

}