
<?php   include_once __DIR__ .'/../templates/content-header.php';?>

  

<!-- Main content -->
<section class="content" id="proveedores">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        
        <!-- /.card -->

        <div class="card">
          <div class="card-header">
              <div class="row justify-content-between">
                <div class="col-4">
                    <h3 class="card-title">Proveedores</h3>
                </div>
                <div class="col-4 d-flex justify-content-end">
                    <button type="button" id="registrar" class="btn bg-hover-azul text-white toolMio" >
                        Registrar Proveedor
                    </button>
                </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="tabla" class="display responsive table w-100 table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>telefono</th>
                  <th >Dirección</th>
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

<div class="modal fade" id="modal-proveedor">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-azul" >
          <h4 class="modal-title text-white">Registrar Proveedor</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="proveedorForm">

            <div class="card-body">
              <div class="form-group">
                <label for="nombre">Nombre / Empresa</label>
                <input type="text" name="nombre"  class="form-control" id="nombre" placeholder="Nombre / Empresa">
              </div>
              <div class="form-group">
                <label for="celular">Celular</label>
                <input type="tel" name="celular"  class="form-control" id="celular" placeholder="Celular">
              </div>

             
              <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion"  class="form-control" id="direccion" placeholder="Dirección">
              </div>
              
          
            </div>
            
           
             
            <div class="card-footer">
                <div class="row justify-content-between">
                    <div class="col-6">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    <div class="">
                        <button type="submit" class="btn bg-hover-azul text-white" id="btnSubmit">Enviar</button>
                    </div>
                </div>
            </div>
          
          </form>
        </div>
      
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>