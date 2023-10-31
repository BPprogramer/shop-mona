<?php 

    namespace Controllers;


use Model\Producto;

    class ApiProductos{
        public static function crear(){
            
            $producto = new Producto($_POST);
            $producto->formatearDatosFloat();
            // if($producto->codigo == ""){
            //     $producto->codigo = null;
            // }
            // $producto->ventas = 0;
            
            $resultado = $producto->guardar();
            
            if($resultado){
                echo json_encode(['type'=>'success', 'msg'=>'El Producto ha sido registrado exitosamente']);
                return;
            }
            echo json_encode(['type'=>'error', 'msg'=>'Hubo un error, porfavor intente nuevamente']);
            return;
        }
        public static function editar(){
            if(!is_admin()){
                echo json_encode(['type'=>'error', 'msg'=>'Hubo un error, porfavor intente nuevamente']);
                return;
            }
            $producto = Producto::find($_POST['id']);
            if(!$producto){
                echo json_encode(['type'=>'error', 'msg'=>'Hay un Problema con el Producto']);
                return;
            }
            $producto->sincronizar($_POST);
          
            $producto->formatearDatosFloat();
           
   
            
            $resultado = $producto->guardar();
            
            if($resultado){
                echo json_encode(['type'=>'success', 'msg'=>'El Producto ha sido actualizado exitosamente']);
                return;
            }
            echo json_encode(['type'=>'error', 'msg'=>'Hubo un error, porfavor intente nuevamente']);
            return;
        }
        public static function editarStock(){
            if(!is_admin()){
                echo json_encode(['type'=>'error', 'msg'=>'Hubo un error, porfavor intente nuevamente']);
                return;
            }

            $producto = Producto::find($_POST['id']);
            if(!$producto){
                echo json_encode(['type'=>'error', 'msg'=>'Hay un Problema con el Producto']);
                return;
            }

            $stock_actual = $producto->stock;
            $precio_compra_actual = $producto->precio_compra;
            $stock_adquirido = $_POST['stock'];
            $precio_compra_adquirido =  floatval(str_replace(',','',$_POST['precio_compra']));

            $stock = $stock_actual+$stock_adquirido;
            $precio_compra = ($stock_actual*$precio_compra_actual+$stock_adquirido*$precio_compra_adquirido)/$stock;
            $producto->stock = $stock;
            $producto->precio_compra = $precio_compra;
            $resultado = $producto->guardar();
            
            if($resultado){
                echo json_encode(['type'=>'success', 'msg'=>'El Producto ha sido actualizado exitosamente']);
                return;
            }
            echo json_encode(['type'=>'error', 'msg'=>'Hubo un error, porfavor intente nuevamente']);
            return;
        }
        public static function eliminar(){
            if(!is_auth()){
                echo json_encode(['type'=>'error', 'msg'=>'Hubo un error, porfavor intente nuevamente']);
                return;
            }
            $id = $_POST['id'];
            if(!$id){
                echo json_encode(['type'=>'error', 'msg'=>'Hubo un error Intenta Nuevamente']);
                return;
            }
            $producto = Producto::find($_POST['id']);
            if(!$producto){
                echo json_encode(['type'=>'error', 'msg'=>'Hay un Problema con el producto']);
                return;
            }
            $resultado = $producto->eliminar();
            if($resultado['status']){
                echo json_encode(['type'=>'success', 'msg'=>'El producto ha sido Eliminado con Exito']);
                return;
            }
            echo json_encode(['type'=>'error', 'msg'=>'Hubo un error, Intenta nuevamente']);
            return;
            
            
        } 

        public static function productos(){
            $productos =Producto::all();
             $i=0;
            $datoJson = '{
             "data": [';
                 foreach($productos as $key=>$producto){
                    $i++;

                    $acciones = "<div class='d-flex justify-content-center' >";
                    $acciones .="<button data-producto-id ='".$producto->id."' id='editar'  type='button' class='btn btn-sm bg-hover-azul mx-2 text-white toolMio'><span class='toolMio-text'>Editar</span><i class='fas fa-pen'></i></button>";
                    $acciones .="<button data-producto-id ='".$producto->id."' id='info'  type='button' class='btn btn-sm bg-hover-azul mx-2 text-white toolMio'><span class='toolMio-text'>Ver</span><i class='fas fa-search'></i></button>";
                    $acciones .="<button data-producto-id ='".$producto->id."' id='eliminar'  type='button' class='btn btn-sm bg-hover-azul mx-2 text-white toolMio' ><span class='toolMio-text'>Eliminar</span><i class='fas fa-trash' ></i></button>";
                    $acciones .="</div>";
 
                  
 
                    $stock = '';
                     if($producto->stock <= $producto->stock_minimo){
                        $stock = "<div class='d-flex justify-content-center' >";
                        $stock .= "<button data-producto-id ='".$producto->id."' id='agregar_stock'  type='button' class='btn  w-65 btn-inline btn-danger btn-sm ' style='min-width:70px'>".$producto->stock ."</button>";
                        $stock .= "</div >";
                     }else{
                        $stock = "<div class='d-flex justify-content-center'>";
                        $stock .= "<button data-producto-id ='".$producto->id."' id='agregar_stock'  type='button' class='btn w-65 btn-inline bg-success text-white btn-sm' style='min-width:70px'>".$producto->stock ."</button>";
                        $stock .= "</div >";
                     }

                     
                     if(!$producto->codigo){
                        $producto->codigo = "";
                     }
                     
                     
                     $datoJson.= '[
                             "'.$i.'",
                             "'.$producto->codigo.'",
                             "'.$producto->nombre.'",
                             "'.$stock.'",
                             "'.number_format($producto->precio_compra).'",
                             "'.number_format($producto->precio_venta).'",
                             "'.$acciones.'"
                     ]';
                     if($key != count($productos)-1){
                         $datoJson.=",";
                     }
                 }
       
             $datoJson.=  ']}';


            echo $datoJson;

        }

        public static function consultarProducto(){
            $id = $_GET['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if(!$id){
                echo json_encode(['type'=>'error', 'msg'=>'Hubo un error, Intenta Nuevamente']);
                return;
            }

            $categoria = Producto::find($id);
            echo json_encode($categoria);
            
        }
    }