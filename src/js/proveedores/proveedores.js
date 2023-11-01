(function(){
    const categorias = document.querySelector('#proveedores');
    if(categorias){
        let tablaProveedores;
        let id = null;
        const btnRegistrarProvedor = document.querySelector('#registrar');
        const formulario = document.querySelector('#proveedorForm');
        const nombre = document.querySelector('#nombre');
        const cedula = document.querySelector('#cedula');
        const celular = document.querySelector('#celular');
        const direccion = document.querySelector('#direccion');
        const email = document.querySelector('#email');
        mostrarProveedores();

        nombre.addEventListener('input',function(e){
            nombre.value =  (e.target.value).toUpperCase();

        })

        btnRegistrarProvedor.addEventListener('click',function(){
            id = null;
            accionesModal();
        })

        $('#tabla').on('click', '#editar', function(e){
            id=e.currentTarget.dataset.proveedorId;
            accionesModal();
        })
        $('#tabla').on('click', '#eliminar', function(e){
            const idProveedor = e.currentTarget.dataset.proveedorId;
            alertaEliminarProveedor(idProveedor,e);
        })

        
     
        
        function alertaEliminarProveedor(id, e){
  
            const proveedor = e.currentTarget.parentElement.parentElement.parentElement.childNodes[1].textContent;
            
            Swal.fire({
                icon:'warning',
                html: `<h2 class="">esta seguro de eliminar al Proveedor <span class="font-weight-bold"> ${proveedor} </span>?</h2><br><p>Esta acción no se puede deshacer</p>`,
          
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                cancelButtonText: `Cancelar`,
                

            }).then(result=>{
                if(result.isConfirmed){
                    eliminarProveedor(id)
                }
            })
        }
        async function eliminarProveedor(id){
            const datos = new FormData();
            datos.append('id', id);
    
            url = `${location.origin}/api/proveedor/eliminar`;
            try {
                const respuesta = await fetch(url,{
                    body:datos,
                    method: 'POST'
                })
                const resultado = await respuesta.json();
                
                eliminarToastAnterior();
            
                if(resultado.type=='error'){
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'Error',
                     
                        body: resultado.msg
                      })
                      setTimeout(()=>{
                        eliminarToastAnterior();
                    },4000)
                }else{

                    $(document).Toasts('create', {
                        class: 'bg-azul text-blanco',
                        title: 'Completado',
                        
                        body: resultado.msg
                    })

                    setTimeout(()=>{
                        eliminarToastAnterior();
                    },8000)

                 
                    tablaProveedores.ajax.reload(); 
                }
            } catch (error) { 
                console.log(error) 
            }
        }
        function mostrarProveedores(){
      
            // $("#tabla").dataTable().fnDestroy(); //por si me da error de reinicializar
    
            tablaProveedores = $('#tabla').DataTable({
                ajax: '/api/proveedores',
                "deferRender":true,
                "retrieve":true,
                "proccesing":true,
                responsive:true,
                initComplete: function () {
                    // Inicializa los botones después de que la tabla se haya creado
                    var buttons = new $.fn.dataTable.Buttons(tablaProveedores, {
                        buttons: ["copy", "csv", "excel", "pdf", "print"]
                    }).container().appendTo('#tabla_wrapper .col-md-6:eq(0)');
                }
            });
            
            // $.ajax({
            //     url:'/api/proveedores',
            //     dataType:'json',
            //     success:function(req){
            //         console.log(req)
            //     },
            //     error:function(error){
            //         console.log(error.resposeText)
            //     }
            // })
       
        }  
        

        function accionesModal(){
            formulario.reset();
            btnSubmit.disabled = false;
            $('#modal-proveedor').modal('show');
       
            inicializarValidador();
            if(id){
                consultarCliente();
            }
        }

        async function consultarCliente(){
            try {
                const respuesta = await fetch(`/api/proveedor?id=${id}`);
                const resultado = await respuesta.json();
                
             
                llenarFormulario(resultado);
            } catch (error) {
                console.log(error)
            }
        }
        function llenarFormulario(resultado){
           
            nombre.value = resultado.nombre;
            celular.value = resultado.celular;
            direccion.value = resultado.direccion;
      
           
        }
         

        async function enviarDatos(){
            const datos = new FormData();
            if(id){
                datos.append('id', id)
            }
            datos.append('nombre', (nombre.value).trim());
            datos.append('celular', (celular.value));
            datos.append('direccion', (direccion.value).trim());


          
            
            btnSubmit.disabled = true;

      
            let url = '';
            if(id){
                url = `${location.origin}/api/proveedor/editar`;
            }else{
                url = `${location.origin}/api/proveedor/crear`;
            }
            
            try {
                const respuesta = await fetch(url,{
                    body:datos,
                    method: 'POST'
                })
                const resultado = await respuesta.json();
               
              
                eliminarToastAnterior();
                btnSubmit.disabled = false;
                if(resultado.type=='error'){
               
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'Error',
                     
                        body: resultado.msg
                    })
                  
                    setTimeout(()=>{
                        eliminarToastAnterior();
                    },0)
                }else{
                    tablaProveedores.ajax.reload()
              
                    $(document).Toasts('create', {
                        class: 'bg-azul text-blanco',
                        title: 'Completado',
                        
                        body: resultado.msg
                    })

                    setTimeout(()=>{
                        eliminarToastAnterior();
                    },4000)

                    formulario.reset();

                    $('#modal-proveedor').modal('hide');
         
                }
   
            } catch (error) {  
                console.log('error')
                // $(document).Toasts('create', {
                //     class: 'bg-danger',
                //     title: 'Error',
                 
                //     body: 'No es Posible eliminar el proveedor porque tiene productos  asociados'
                //   })

                // setTimeout(()=>{
                //     eliminarToastAnterior();
                // },8000) 
            }
        }

        function eliminarToastAnterior(){
            if(document.querySelector('#toastsContainerTopRight')){
                document.querySelector('#toastsContainerTopRight').remove()
            }
        }

        function inicializarValidador() {
        
            $.validator.setDefaults({
              submitHandler: function () {
                        enviarDatos();
              }
            });
      
           
             $('#proveedorForm').validate({
              rules: {
                nombre: {
                    required: true,
                    minlength: 2  
                },
                celular: {
             
                    digits:true,
                    rangelength: [10, 10]   
                }
              

              },
              messages: {
                nombre: {
                    required: "El nombre es obligatorio",
                    minlength: "Debe tener al menos 2 caracteres"   
                },
                celular: {
            
                    digits: "Solo valores númericos",
                    rangelength:  "el número de celular debe tener 10 digitos"
                }
              
              },
              errorElement: 'span',
              errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
              },
              highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
              },
              unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
              }
            });
          };
          $('#proveedorForm').on('valid', function(event) {
            inicializarValidador();
        });
    }
})();