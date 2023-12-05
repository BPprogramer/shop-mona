<?php include_once __DIR__ . '/../templates/content-header.php'; ?>

<!-- Main content -->
<section class="content" id="mercadolibre">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

        <!-- /.card -->

        <div class="card">
          <div class="card-header">
            <div class="row justify-content-between">
              <div class="col-4">
                <h3 class="card-title">Mercado Libre</h3>
              </div>
             <!--  <div class="col-4 d-flex justify-content-end">
                <button type="button" id="registrar" class="btn bg-hover-azul text-white toolMio">
                  Registrar Producto
                </button>
              </div> -->
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="tabla" class="display responsive table w-100 table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Venta No</th>
                  <th>Total</th>
                  <th>Total Con Comisión</th>
                  <th>Recaudo</th>

                  <th>Estado</th>
                  <th>Fecha</th>


                  <th class="text-center">Acciones</th>
                </tr>
              </thead>

            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>



<!-- modal infomracion -->
<div class="modal fade" id="modal-info">
    <div class="modal-dialog modal-70rem">
        <div class="modal-content">
            <div class="modal-header bg-azul">
                <h4 class="modal-title text-white mx-3">Información</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">

                <!-- informacion general -->
                <div class="row">
                    <div class="col-md-6 pr-4">
                        <div class="d-flex justify-content-between  border-bottom">
                            <p class="my-2">Venta No: </p>
                            <p class="my-2"><strong class="text-danger" id="codigo-venta"></strong></p>
                        </div>


                    </div>
                    <div class="col-md-6 pl-4">
                        <div class="d-flex justify-content-between border-bottom">
                            <p class="my-2">Total: </p>
                            <p class="my-2"><strong class="" id="total-venta"></strong></p>
                        </div>
                    </div>
                  
                    <div class="col-md-6 pr-4">
                        <div class="d-flex justify-content-between  border-bottom">
                            <p class="my-2">Cliente: </p>
                            <p class="my-2"><strong class="" id="cliente-venta"></strong></p>
                        </div>
                    </div>
                    <div class="col-md-6 pl-4">
                        <div class="d-flex justify-content-between border-bottom">
                            <p class="my-2">Abono: </p>
                            <p class="my-2"><strong class="" id="recaudo-venta"></strong></p>
                        </div>
                    </div>
                  
                    <div class="col-md-6  pr-4">
                        <div class="d-flex justify-content-between border-bottom">
                            <p class="my-2">Fecha: </p>
                            <p class="my-2"><strong class="" id="fecha-venta"></strong></p>
                        </div>
                    </div>
                    <div class="col-md-6 pl-4">
                        <div class="d-flex justify-content-between  border-bottom">
                            <p class="my-2">Saldo </p>
                            <p class="my-2"><strong class="text-danger" id="saldo-venta"></strong></p>
                        </div>


                    </div>
                    <div class="col-md-6 pr-4">
                      
                        <div class="d-flex justify-content-between  border-bottom">
                            <p class="my-2">Estado </p>
                            <p class="my-2"><strong class="" id="estado-venta"></strong></p>
                        </div>

                    </div>
                    <div class="col-md-6 pl-4">
                        <div class="d-flex justify-content-between  border-bottom">
                            <p class="my-2">metodo de pago </p>
                            <p class="my-2"><strong class="" id="metodo-venta"></strong></p>
                        </div>


                    </div>
                    <div class="col-md-6 pl-4">
                        

                    </div>
                    <div class="col-md-6 pl-4">
                        <div class="d-flex justify-content-between  border-bottom">
                            <p class="my-2">Total Sin Comisión </p>
                            <p class="my-2"><strong class="" id="total-sin-comision"></strong></p>
                        </div>


                    </div>
                   
                    
                    

                </div>
          
                <!-- informacion de los productos -->

                <div class="mt-4">
                  
                        <table class="table table-striped text-md" id="tabla-productos-fiados">
                            <thead class="thead">
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>precio unitario</th>
                                    <th>subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="body-productos-venta">
                             <!--    <tr>
                                    <td>Ron Viejo de Caldas</td>
                                    <td>2</td>
                                    <td>25,000</td>
                                    <td>50,000</td>
                                </tr> -->
                            </tbody>
                        </table>
                 
                </div>

            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

