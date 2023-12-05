<?php 



    namespace Controllers;
    use MVC\Router;

    class MercadoLIbreController{
        public static function index(Router $router){
            if(!is_auth()){
                header('Location:/login');
            }
            $router->render('mercadolibre/index',[
                'titulo' => 'Ventas en Mercado Libre',
                'nombre'=>$_SESSION['nombre']
            
            ]);
        }
    }