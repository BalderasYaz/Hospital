<?php include "Views/Templates/header.php"; ?>
<div class="row align-items-center">
  <div class="col-8 col-md-9">
    <h1 class="h4">Invetario de Farmacia</h1>
  </div>
  <div class="col-4 col-md-3 text-right">
    <button class="btn btn-primary ml-2" type="button" onclick="frmFarmacia();">+</button>
    <button class="btn btn-danger ml-2" type="button" onclick="mostrarMedicamentosMenosDeCinco();">Ver medicamentos por agotarse</button>
  </div>
</div>
<div class="row mt-4">
  <div class="col">
    <table class="table table-light" id="tblMedicamentos">
      <thead class="thead-light">
        <tr>
          <th>Id_registro</th>
          <th>Nombre Comercial</th>
          <th>Descripción</th>
          <th>Cantidad</th>
          <th>Precio</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>
<div id="nuevo_medicamento" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Nuevo registro</h5>
        <button class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="frmFarmacia">
          <div class="form-group">
            <div class="form-group">
              <label for="Nombre_Comercial">Nombre Comercial</label>
              <input type="hidden" id="id" name="id">
              <input id="Nombre_Comercial" class="form-control" type="text" name="Nombre_Comercial" placeholder="Nombre_Comercial">
            </div>
            <div class="form-group">
              <label for="Descripcion">Descripción</label>
              <input id="Descripcion" class="form-control" type="text" name="Descripcion" placeholder="Descripcion">
            </div>
            <div class="form-group">
              <label for="Cantidad">Cantidad</label>
              <input id="Cantidad" class="form-control" type="text" name="Cantidad" placeholder="Cantidad">
            </div>
            <div class="form-group">
              <label for="Precio">Precio</label>
              <input id="Precio" class="form-control" type="text" name="Precio" placeholder="Precio">
            </div>
            <button class="btn btn-primary mb-3" type="button" onclick="registrarMedicamento(event);" id="accion">Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>




<?php include "Views/Templates/footer.php"; ?>


