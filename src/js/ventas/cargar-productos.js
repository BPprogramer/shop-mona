// (function(){
//     const seccionCrearVentas = document.querySelector('#seccion-crear-ventas')
//     if(seccionCrearVentas){
//         let tablaProductos;
//         const selectProductos = document.querySelector('#selectProductos');


//         consultarProductos();

//         async function consultarProductos(){
            
            
//             try {
//                 const respuesta = await fetch(`${location.origin}/api/productos-ventas`);
//                 const resultado =  await respuesta.json();
               
//                 // llenarPrimerOption(selectCategorias);
//                 const opcionDisabled =   document.createElement('OPTION');
//                 opcionDisabled.textContent = '--seleccione un producto--';
//                 opcionDisabled.value = "0";

//                 selectProductos.appendChild(opcionDisabled);
//                 resultado.forEach(producto => {
                    
//                     const opcion =   document.createElement('OPTION');
//                     opcion.value = producto.id;
//                     opcion.textContent = producto.nombre;
                  
                   
//                     selectProductos.appendChild(opcion)
            
//                 });
         
//                 $('#selectProductos').select2()
//                 $('.select2bs4').select2({
//                     theme: 'bootstrap4'
//                 })
//             } catch (error) {
                
//             }
//             $('#selectProductos').select2()
//             $('.select2bs4').select2({
//                 theme: 'bootstrap4'
//             })
        
       
//         }  
//     }
// })();