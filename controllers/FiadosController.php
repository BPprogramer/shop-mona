<?php 

    namespace Controllers;

use MVC\Router;

class FiadosController {

    public static function index(Router $router){
        
        if(!is_auth()){
            header('Location:/login');
        }
        
        $router->render('fiados/index', [
            'titulo' => 'Fiados',
            'nombre'=>$_SESSION['nombre']
        
        ]);
    }

}