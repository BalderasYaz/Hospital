<?php include "Views/Templates/header.php"; ?> 
<div class="row align-items-center">
  <div class="col-8 col-md-9">
    <h1 class="h4">Registros estudios de laboratorio</h1>
  </div>
  <div class="col-4 col-md-3 text-right">
    <button class="btn btn-primary" type="button" onclick="frmEstudio();">+</button>
    <button class="btn btn-primary ml-2" type="button" onclick="frmfitro();">Filtrar</button>
    <button class="btn btn-danger ml-2" type="button" onclick="eliminarflt();">Eliminar filtro</button>
  </div>
</div>
<div class="row mt-4">
  <div class="col">
    <table class="table table-light" id="tblEstudios">
      <thead class="thead-light">
          <th>Id_estudio</th>
          <th>Nombre</th>
          <th>Cantidad</th>
          <th>Cuota</th>
          <th>Paciente</th>
          <th>Fecha</th>
          <th>Total</th>
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
  <button id="calcular2" class="btn btn-primary">Calcular Total</button>
  <button class="btn btn-danger ml-2" type="button" onclick="eliminarflt();">Borrar datos</button>
 <!-- <button type="button" onclick="generarPDF();">Generar PDF</button>-->
</div>
</div>
  <div id="nuevo_registro" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="title">Nuevo registro</h5>
          <button class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" id="frmEstudio">
            <div class="form-group">
            <label for="Nombre">Nombre del estudio</label>
            <select id="Nombre" class="form-control" name="Nombre" onchange="actualizarCuota();">
            <?php foreach ($data['id'] as $row) {?>
            <option value="<?php echo $row['Id_estudio']; ?>"><?php echo $row['Nombre']; ?></option>
            <?php }?>
          </select>
            </div>
            <div class="form-group">
              <label for="Cantidad">Cantidad</label>
              <input id="Cantidad" class="form-control" type="text" name="Cantidad" placeholder="Cantidad">
            </div>
            <div class="form-group">
              <label for="Cuota">Cuota</label>
              <input id="Cuota" class="form-control" type="text" name="Cuota" placeholder="Cuota">
            </div>
            <div class="form-group">
              <label for="Paciente">Paciente</label>
              <input id="Paciente" class="form-control" type="text" name="Paciente" placeholder="Nombre completo del paciente">
            </div>
            <div class="form-group">
              <label for="Fecha">Fecha</label>
              <input id="Fecha" class="form-control" type="date" name="Fecha" placeholder="Fecha">
            </div>
            <button class="btn btn-primary mb-3" type="button" onclick="registrarEstudio(event);" id="accion">Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div id="filtrofecha" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="title">Filtrar por fecha</h5>
          <button class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" id="frmfitro">
            <div class="form-group">
              <label for="Fecha">Fecha de inicio</label>
              <input id="Fechain" class="form-control" type="date" name="Fechain" placeholder="Fecha">
            </div>
            <div class="form-group">
              <label for="Fecha">Fecha de termino</label>
              <input id="Fechater" class="form-control" type="date" name="Fechater" placeholder="Fecha">
            </div>
            <button class="btn btn-primary mb-3" type="button" onclick="fitrarregistro(event);" id="btnfiltro">Filtrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-4">
  <div class="col">
    <h1 class="h4">Concentrado estudios de laboratorio</h1>
  </div>
</div>
<div class="row mt-4">
  <div class="col">
  <table class="table table-light mb-4" id="tbltotales">
    <thead class="thead-light mb-4">
      <tr>
        <th>Nombre</th>
        <th>Cantidad</th>
        <th>Total</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
  </div>
</div>

  <p class="h6" id="total2"></p>
  <p class="h6" id="total3"></p>
  <p class="h6" id="total_pacientes"></p>
  
<canvas id="grafico"></canvas>
<?php include "Views/Templates/footer.php"; ?>