
<?php   include_once __DIR__ .'/../templates/content-header.php';?>

  

<!-- Main content -->
<section class="content" id="categorias">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        
        <!-- /.card -->

        <div class="card">
          <div class="card-header">
              <div class="row justify-content-between">
                <div class="col-4">
                    <h3 class="card-title">Categorías</h3>
                </div>
                <div class="col-4 d-flex justify-content-end">
                    <button type="button" id="registrar" class="btn bg-hover-azul text-white toolMio" >
                        Crear Categoría
                        
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
                <th>Categoria</th>
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

<div class="modal fade" id="modal-categoria">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-azul" >
          <h4 class="modal-title text-white ">Crear Categoría</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="categoriaForm">

            <div class="card-body">
              <div class="form-group">
                <label for="categoria">Categoría</label>
                <input type="categoria" name="categoria"  class="form-control" id="categoria" placeholder="nombre de la categoria">
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