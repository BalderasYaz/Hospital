<?php include "Views/Templates/header.php"; ?>
<div class="row align-items-center">
  <div class="col-2 col-md-9">
    <h1 class="h4">Registros de ingresos generales</h1>
  </div>
  <div class="col-4 col-md-3 text-right">
  <button class="btn btn-primary" type="button" onclick="frmingreso();">+</button>
  <button class="btn btn-primary ml-2" type="button" onclick="frmfitro2();">Filtrar</button>
  <button class="btn btn-danger ml-2" type="button" onclick="eliminarflt();">Eliminar filtro</button>
  <label for="Paciente">Paciente.</label>
  <input id="Paciente" class="form-control" type="text" name="Paciente" placeholder="Nombre completo del paciente">
  <button class="btn btn-primary ml-2" type="button" onclick="ticket();">Generar ticket</button>
  </div>
</div>
<div class="row mt-4">
  <div class="col">
  <table class="table table-light " id="tblIngresos">
    <thead class="thead-light">
      <tr>
        <th>Id_tipo</th>
        <th>Nombre</th>
        <th>Cuota de recuperación</th>
        <th>Paciente</th>
        <th>Fecha</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
  </div>
</div>
<div class="row mt-4">
<div class="col">
  <button id="calcular" class="btn btn-primary">Calcular Total</button>
  <button class="btn btn-danger ml-2" type="button" onclick="eliminarflt();">Borrar datos</button>
</div>
</div>
  <div id="nuevo_ingreso" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="title">+</h5>
          <button class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" id="frmingreso">
            <div class="form-group">
              <label for="Nombre">Tipo de ingreso</label>
              <select id="Nombre" class="form-control" name="Nombre">
              <?php foreach ($data['id'] as $row) {?>
              <option><?php echo $row['Nombre']; ?></option>
              <?php }?>
              </select>
            </div>
            <div class="form-group">
              <label for="cuota">Cuota de recuperación</label>
              <input id="cuota" class="form-control" type="text" name="cuota" placeholder="cuota">
            </div>
            <div class="form-group">
              <label for="Paciente<">Paciente</label>
              <input id="Paciente" class="form-control" type="text" name="Paciente" placeholder="Nombre completo del paciente">
            </div>
            <div class="form-group">
              <label for="Fecha">Fecha</label>
              <input id="Fecha" class="form-control" type="date" name="Fecha" placeholder="Fecha">
            </div>
            <button class="btn btn-primary mb-3" type="button" onclick="registraringreso(event);" id="accion">Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div id="filtrofecha2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="title">Filtrar por fecha</h5>
          <button class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" id="frmfitro2">
            <div class="form-group">
              <label for="Fecha">Fecha de inicio</label>
              <input id="Fechain2" class="form-control" type="date" name="Fechain2" placeholder="Fecha">
            </div>
            <div class="form-group">
              <label for="Fecha">Fecha de termino</label>
              <input id="Fechater2" class="form-control" type="date" name="Fechater2" placeholder="Fecha">
            </div>
            <button class="btn btn-primary mb-3" type="button" onclick="fitrarregistro(event);" id="btnfiltro2">Filtrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4">
  <div class="col">
    <h1 class="h4">Concentrado de ingresos generales</h1>
  </div>
</div>
  <div class="row mt-4">
  <div class="col">
  <table class="table table-light mb-4" id="tbltotal">
    <thead class="thead-light mb-4">
      <tr>
        <th>Tipo de ingreso</th>
        <th>Cantidad</th>
        <th>Total</th>
        <th>Total de pacientes</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
  </div>
</div>
<p class="h6" id="total"></p>
<p class="h6"  id="Can"></p>

<canvas id="grafico2"></canvas>
<?php include "Views/Templates/footer.php"; ?>