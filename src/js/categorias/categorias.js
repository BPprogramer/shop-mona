(function(){
    const categorias = document.querySelector('#categorias');
    if(categorias){
        let tablaCategorias;
        let id = null;
        let idCategoria = null;
        let idProveedor = null;
        const btnRegistrarCategoria = document.querySelector('#registrar');
        const formulario = document.querySelector('#categoriaForm');
        const categoria = document.querySelector('#categoria');
        mostrarCategorias();



        categoria.addEventListener('input',function(e){
            categoria.value =  (e.target.value).toUpperCase();

        })
        btnRegistrarCategoria.addEventListener('click',function(){
            id = null;
            accionesModal();
        })

        
        $('#tabla').on('click', '#editar', function(e){
            id=e.currentTarget.dataset.categoriaId;
            accionesModal();
        })
        $('#tabla').on('click', '#eliminar', function(e){
            const idCategoria = e.currentTarget.dataset.categoriaId;
            alertaEliminarCategoria(idCategoria,e);
        })

       
     
        
        function alertaEliminarCategoria(id, e){
  
            const categoria = e.currentTarget.parentElement.parentElement.parentElement.childNodes[1].textContent;
            
            Swal.fire({
                icon:'warning',
                html: `<h2 class="">esta seguro de eliminar la categoría <span class="font-weight-bold"> ${categoria} </span>?</h2><br><p>Esta acción no se puede deshacer</p>`,
          
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                cancelButtonText: `Cancelar`,
                

            }).then(result=>{
                if(result.isConfirmed){
                    eliminarCategoria(id)
                }
            })
        }
        async function eliminarCategoria(id){
            const datos = new FormData();
            datos.append('id', id);
    
            url = `${location.origin}/api/categoria/eliminar`;
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

                 
                    tablaCategorias.ajax.reload(); 
                }
            } catch (error) { 
                $(document).Toasts('create', {
                    class: 'bg-danger',
                    title: 'Error',
                 
                    body: 'No es Posible eliminar la cateogoría porque tiene productos  asociados'
                  })

                setTimeout(()=>{
                    eliminarToastAnterior();
                },8000)
            }
        }
        function mostrarCategorias(){
 
            $("#tabla").dataTable().fnDestroy(); //por si me da error de reinicializar
    
            tablaCategorias = $('#tabla').DataTable({
                ajax: '/api/categorias',
                "deferRender":true,
                "retrieve":true,
                "proccesing":true,
                responsive:true,
                initComplete: function () {
                    // Inicializa los botones después de que la tabla se haya creado
                    var buttons = new $.fn.dataTable.Buttons(tablaCategorias, {
                        buttons: ["copy", "csv", "excel", "pdf", "print"]
                    }).container().appendTo('#tabla_wrapper .col-md-6:eq(0)');
                }
            });
            
            // $.ajax({
            //     url:'/api/categorias',
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
            $('#modal-categoria').modal('show');
            inicializarValidador();
            if(id){
                consultarCategoria();
            }
        }

        async function consultarCategoria(){
            try {
                const respuesta = await fetch(`/api/categoria?id=${id}`);
                const resultado = await respuesta.json();
            
             
                llenarFormulario(resultado);
            } catch (error) {
                console.log(error)
            }
        }
        function llenarFormulario(resultado){
           
            categoria.value = resultado.categoria;
           
        }
         

        async function enviarDatos(){
            const datos = new FormData();
            if(id){
                datos.append('id', id)
            }
            datos.append('categoria', (categoria.value).trim());
           
         
            btnSubmit.disabled = true;
            let url = '';
            if(id){
                url = `${location.origin}/api/categoria/editar`;
            }else{
                url = `${location.origin}/api/categoria/crear`;
            }
            
            try {
                const respuesta = await fetch(url,{
                    body:datos,
                    method: 'POST'
                })
                const resultado = await respuesta.json();
               
              ;
                eliminarToastAnterior();
                btnSubmit.disabled = false;
                if(resultado.type=='error'){
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'Error',
                     
                        body: resultado.msg
                      })
                }else{
                    tablaCategorias.ajax.reload()

                    $(document).Toasts('create', {
                        class: 'bg-azul text-blanco',
                        title: 'Completado',
                        
                        body: resultado.msg
                    })

                    setTimeout(()=>{
                        eliminarToastAnterior();
                    },4000)

                    formulario.reset();

                 
                    $('#modal-categoria').modal('hide');
                    //tablaCategorias.ajax.reload(); 
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
   
            
             $('#categoriaForm').validate({
              rules: {
                categoria: {
                    required: true
                }
              },
              messages: {
                categoria: {
                    required: "El nombre de la categoría es obligatorio"
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
          $('#categoriaForm').on('valid', function(event) {
            inicializarValidador();
        });
    }
})();