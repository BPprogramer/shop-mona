<?php


namespace Controllers;
use MVC\Router;


class IngresosController{
    public static function index(Router $router){
        if(!is_auth()){
            header('Location:/login');
        }
        $router->render('transacciones/ingresos',[
            'titulo'=>'Ingresos',
            'nombre'=>$_SESSION['nombre']
        ]);
    }
}