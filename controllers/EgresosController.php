<?php


namespace Controllers;
use MVC\Router;


class EgresosController{
    public static function index(Router $router){
        if(!is_auth()){
            header('Location:/login');
        }
        $router->render('transacciones/egresos',[
            'titulo'=>'Egregos',
            'nombre'=>$_SESSION['nombre']
        ]);
    }
}