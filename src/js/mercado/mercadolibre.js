// (async function(){
//     const mercadolibre = document.querySelector('#mercadolibre');
//     if(mercadolibre){

//         let tablaMercadoLibre

//         await pagosAuto();
//         await mostrarVentas()

//         async function pagosAuto(){
       
//             try {
//                 const respuesta = await fetch(`${location.origin}/api/pagos-auto`);
//                 const resultado = await respuesta.json();
        
               
//             } catch (error) {
                
//             }
//         }


//         function mostrarVentas(){
 
//             $("#tabla").dataTable().fnDestroy(); //por si me da error de reinicializar
    
//             tablaMercadoLibre = $('#tabla').DataTable({
//                 ajax: '/api/mercadolibre',
//                 "deferRender":true,
//                 "retrieve":true,
//                 "proccesing":true,
//                 responsive:true,
//                 initComplete: function () {
//                     // Inicializa los botones después de que la tabla se haya creado
//                     var buttons = new $.fn.dataTable.Buttons(tablaMercadoLibre, {
//                         buttons: ["copy", "csv", "excel", "pdf", "print"]
//                     }).container().appendTo('#tabla_wrapper .col-md-6:eq(0)');
//                 }
//             });
            
//             $.ajax({
//                 url:'/api/mercadolibre',
//                 dataType:'json',
//                 success:function(req){
//                     console.log(req)
//                 },
//                 error:function(error){
//                     console.log(error.resposeText)
//                 }
//             })
       
//         }  
        
//     }
// })();