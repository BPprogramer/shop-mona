(function(){
    const categorias = document.querySelector('#clientes');
    if(categorias){
        let tablaClientes;
        let id = null;
        const btnRegistrarCliente = document.querySelector('#registrar');
        const formulario = document.querySelector('#clienteForm');
        const nombre = document.querySelector('#nombre');
        const cedula = document.querySelector('#cedula');
        const celular = document.querySelector('#celular');
        const direccion = document.querySelector('#direccion');
        const email = document.querySelector('#email');
        mostrarClientes();
 

        btnRegistrarCliente.addEventListener('click',function(){
            id = null;
            accionesModal();
        })

        $('#tabla').on('click', '#editar', function(e){
            id=e.currentTarget.dataset.clienteId;
            accionesModal();
        })
        $('#tabla').on('click', '#eliminar', function(e){
            const idCliente = e.currentTarget.dataset.clienteId;
            alertaEliminarCliente(idCliente,e);
        })
       
        
        function alertaEliminarCliente(id, e){
  
            const cliente = e.currentTarget.parentElement.parentElement.parentElement.childNodes[1].textContent;
            
            Swal.fire({
                icon:'warning',
                html: `<h2 class="">esta seguro de eliminar al Cliente <span class="font-weight-bold"> ${cliente} </span>?</h2><br><p>Esta acción no se puede deshacer</p>`,
          
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                cancelButtonText: `Cancelar`,
                

            }).then(result=>{
                if(result.isConfirmed){
                    eliminarCliente(id)
                }
            })
        }
        async function eliminarCliente(id){
            const datos = new FormData();
            datos.append('id', id);
    
            url = `${location.origin}/api/cliente/eliminar`;
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
                }else{

                    $(document).Toasts('create', {
                        class: 'bg-azul text-blanco',
                        title: 'Completado',
                        
                        body: resultado.msg
                    })

                    setTimeout(()=>{
                        eliminarToastAnterior();
                    },8000)

                 
                    tablaClientes.ajax.reload(); 
                }
            } catch (error) { 
                console.log(error) 
            }
        }
        function mostrarClientes(){
      
            $("#tabla").dataTable().fnDestroy(); //por si me da error de reinicializar
    
            tablaClientes = $('#tabla').DataTable({
                ajax: '/api/clientes',
                "deferRender":true,
                "retrieve":true,
                "proccesing":true,
                responsive:true,
                initComplete: function () {
                    // Inicializa los botones después de que la tabla se haya creado
                    var buttons = new $.fn.dataTable.Buttons(tablaClientes, {
                        buttons: ["copy", "csv", "excel", "pdf", "print"]
                    }).container().appendTo('#tabla_wrapper .col-md-6:eq(0)');
                }
            });
            
            // $.ajax({
            //     url:'/api/clientes',
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
            $('#modal-cliente').modal('show');
            inicializarValidador();
            if(id){
                consultarCliente();
            }
        }

        async function consultarCliente(){
            try {
                const respuesta = await fetch(`/api/cliente?id=${id}`);
                const resultado = await respuesta.json();
            
             
                llenarFormulario(resultado);
            } catch (error) {
                console.log(error)
            }
        }
        function llenarFormulario(resultado){
           
            nombre.value = resultado.nombre;
            cedula.value = resultado.cedula;
            celular.value = resultado.celular;
            direccion.value = resultado.direccion;
            email.value = resultado.email;
           
        }
         

        async function enviarDatos(){
            const datos = new FormData();
            if(id){
                datos.append('id', id)
            }
            datos.append('nombre', (nombre.value).trim());
            datos.append('cedula', (cedula.value));
            datos.append('celular', (celular.value));
            datos.append('direccion', (direccion.value).trim());
            datos.append('email', (email.value).trim());
           
            
            btnSubmit.disabled = true;

      
            let url = '';
            if(id){
                url = `${location.origin}/api/cliente/editar`;
            }else{
                url = `${location.origin}/api/cliente/crear`;
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
                }else{
                    tablaClientes.ajax.reload()

                    $(document).Toasts('create', {
                        class: 'bg-azul text-blanco',
                        title: 'Completado',
                        
                        body: resultado.msg
                    })

                    setTimeout(()=>{
                        eliminarToastAnterior();
                    },4000)

                    formulario.reset();

                    $('#modal-cliente').modal('hide');
         
                }
   
            } catch (error) {  
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
      
           
             $('#clienteForm').validate({
              rules: {
                nombre: {
                    required: true,
                    minlength: 6   
                },
                cedula: {
                    required: true,
                    digits:true,
                    minlength: 6   
                },
                celular: {
                    required: true,
                    digits:true,
                    rangelength: [10, 10]   
                },
                email:{
                    email:true,
                }

              },
              messages: {
                nombre: {
                    required: "El nombre es obligatorio",
                    minlength: "Debe tener al menos 6 caracteres"   
                },
                cedula: {
                    required: "El númer de cédula es obligaotrio",
                    digits: "Solo valores númericos",
                    minlength:  "Debe tener al menos 6 numeros",
                },
                celular: {
                    required: "El número de celular es obligatorio",
                    digits:"solo valores numericos",
                    rangelength: "Debe contener 10 números" 
                },
               
                email:{
                    email:"el email no es valido"
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
          $('#clienteForm').on('valid', function(event) {
            inicializarValidador();
        });
    }
})();