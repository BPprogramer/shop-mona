<?php


namespace Controllers;
use MVC\Router;


class IngresosController{
    public static function index(Router $router){
        if(!is_auth()){
            header('Location:/login');
        }
        $router->render('transacciones/ingresos',[
            'titulo'=>'Ingregos',
            'nombre'=>$_SESSION['nombre']
        ]);
    }
}