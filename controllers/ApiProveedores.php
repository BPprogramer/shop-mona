<?php 
    namespace Controllers;


use Model\Cliente;
use Model\Proveedor;

    class ApiProveedores{
        public static function proveedores(){
            $proveedores = Proveedor::all();

   
            
           
            $i=0;
            $datoJson = '{
             "data": [';
                 foreach($proveedores as $key=>$proveedor){
                    $i++;

                    $acciones = "<div class='d-flex justify-content-center' >";
                    $acciones .="<button data-proveedor-id ='".$proveedor->id."' id='editar'  type='button' class='btn btn-sm bg-hover-azul mx-2 text-white toolMio' ><span class='toolMio-text'>Editar</span><i class='fas fa-pen'></i></button>";
                    $acciones .="<button data-proveedor-id ='".$proveedor->id."' id='eliminar'  type='button' class='btn btn-sm bg-hover-azul  mx-2  text-white toolMio'><span class='toolMio-text'>Eliminar</span><i class='fas fa-trash'></i></button>";
                    $acciones .="</div>";
                   
                    $deuda = "<div class='d-flex justify-content-center' >";
                    $deuda .= "<button type='button' class='btn  w-75 btn-inline btn-secondary btn-sm ' style='min-width:70px'>Calcular</span><i class='fas fa-math'></i></button>";
                    $deuda .= "</div >";

                   
                
                     $datoJson.= '[
                             "'.$i.'",
                             "'.$proveedor->nombre.'",
                             "'.$proveedor->celular.'",
                             "'.$proveedor->direccion.'",
                             "'.$acciones.'"
                     ]';
                     if($key != count($proveedores)-1){
                         $datoJson.=",";
                     }
                 }
       
             $datoJson.=  ']}';
             echo $datoJson;
            
        }

        public static function proveedoresAll(){
            $proveedores = Proveedor::all();
            echo json_encode($proveedores);
        }

        public static function consultarProveedor(){
            $id = $_GET['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if(!$id){
                echo json_encode(['type'=>'error', 'msg'=>'Hubo un error, Intenta Nuevamente']);
                return;
            }

            $proveedor = Proveedor::find($id);
            echo json_encode($proveedor);
            
        }


        public static function crear(){


            $proveedor = new Proveedor($_POST);
    
            $resultado = $proveedor->guardar();
            if($resultado){
                echo json_encode(['type'=>'success', 'msg'=>'El proveedor ha sido registrado exitosamente']);
                return;
            }
            echo json_encode(['type'=>'error', 'msg'=>'Hubo un error, porfavor intente nuevamente']);
            return;
        }

        public static function editar(){

            $id = $_POST['id'];
            if(!$id){
                echo json_encode(['type'=>'error', 'msg'=>'Hubo un error Intenta Nuevamente']);
                return;
            }
           
    
            $proveedor = Proveedor::find($_POST['id']);
            if(!$proveedor){
                echo json_encode(['type'=>'error', 'msg'=>'Hay un Problema con el Proveedor']);
                return;
            }
        
            $proveedor->sincronizar($_POST);
          
          
    
            $resultado = $proveedor->guardar();
            if($resultado){
                echo json_encode(['type'=>'success', 'msg'=>'El Proveedor ha sido Actualizado con Exito']);
                return;
            }
            echo json_encode(['type'=>'error', 'msg'=>'Hubo un error, Intenta nuevamente']);
            return;
       
        }

        public static function eliminar(){
            $id = $_POST['id'];
            if(!$id){
                echo json_encode(['type'=>'error', 'msg'=>'Hubo un error Intenta Nuevamente']);
                return;
            }
            $proveedor = Proveedor::find($_POST['id']);
            if(!$proveedor){
                echo json_encode(['type'=>'error', 'msg'=>'Hay un Problema con el proveedor']);
                return;
            }
            $resultado = $proveedor->eliminar();
     
            if($resultado['status']){
                echo json_encode(['type'=>'success', 'msg'=>'El proveedor ha sido Eliminado con Exito']);
                return;
            }
            if($resultado['code']==1451){
                echo json_encode(['type'=>'error', 'msg'=>'No es Posible eliminar el proveedor porque tiene productos  asociados']);
                return;
                
            }
         
            echo json_encode(['type'=>'error', 'msg'=>'Hubo un error, Intenta nuevamente']);
            return;
            
            
        }  
    }