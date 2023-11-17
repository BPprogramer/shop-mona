(function(){
    const seccionFiados = document.querySelector('#seccion-fiados');
    if(seccionFiados){
   

        const enlaceDeudas = document.querySelector('#enlace-deudas');
        const enlacePagos = document.querySelector('#enlace-pagos');
        const contenedorDeudas = document.querySelector('#contenedor-deudas');
        const contenedorPagos = document.querySelector('#contenedor-pagos');

        enlaceDeudas.addEventListener('click',()=>{
            const active = document.querySelector('.active-nav');
            active.classList.remove('active-nav')
            enlaceDeudas.classList.add('active-nav')

            const dNones = document.querySelectorAll('.d-none');
            dNones.forEach(dNone=>{
                dNone.classList.remove('d-none')
            })
            contenedorPagos.classList.add('d-none')
       
            
          
        })
        enlacePagos.addEventListener('click',()=>{
            const active = document.querySelector('.active-nav');
            active.classList.remove('active-nav')
            enlacePagos.classList.add('active-nav')

            const dNones = document.querySelectorAll('.d-none');
            dNones.forEach(dNone=>{
                dNone.classList.remove('d-none')
            })
            contenedorDeudas.classList.add('d-none')
         
        })
  
    }
})();