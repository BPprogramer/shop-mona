<?php 

    namespace Controllers;

use MVC\Router;

    class DashboardController{
        public static function index(Router $router){
            // session_start();
            if(!is_auth()){
                header('Location:/login');
            }
            $router->render('inicio/index',[
                'titulo'=>'Inicio',
                'nombre'=>$_SESSION['nombre']
            ]);
        }
    }