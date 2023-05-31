let tblEstudios,tblIngresos,tblTotales,tblMedicamentos;

document.addEventListener("DOMContentLoaded", function () {
    tblEstudios = $('#tblEstudios').DataTable({
        ajax: {
            url: 'http://localhost:8081/Hospital/Usuarios/filtrarfecha',
            type: 'POST',
            data: function (d) {
              d.Fechain = $('#Fechain').val();
              d.Fechater = $('#Fechater').val();
            },
            dataSrc: 'data'
        },
        columns: [
            { data: 'Id_estudio' },
            { data: 'Nombre' },
            { data: 'Cantidad' },
            { data: 'Cuota' },
            { data: 'Paciente'},
            { data: 'Fecha' },
            { data: 'Total' },
            { data: 'acciones'}
        ],
        language: {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros  _START_ - _END_  total _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros 0 - 0  total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:&nbsp;",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad"
            }
        }
    });
    $('#btnfiltro').on('click', function () {
      tblEstudios.ajax.reload();
    });
    $('#calcular2').click(function() {
  var pacientes = {};
  tblEstudios.column(4).data().each(function(valor) {
    var nombre = valor.toLowerCase().trim();
    if (!pacientes[nombre]) {
      pacientes[nombre] = true;
    }
  });
  var num_pacientes = Object.keys(pacientes).length;
  $('#total_pacientes').text('Número de pacientes: ' + num_pacientes);
      var total2 = 0;
      var totalcantidad = 0;
      tblEstudios.column(2).data().each(function(valor) {
        totalcantidad += parseInt(valor);
      });
      tblEstudios.column(6).data().each(function(valor) {
        total2 += parseFloat(valor);
      });
      $('#total3').text('Total de estudios: ' + totalcantidad);
      $('#total2').text('Total de ingresos: ' + total2.toFixed(2));
      var productos_unicos = [];
      var producto;
      $("#tblEstudios tbody tr").each(function(){
      producto = $(this).find("td:eq(1)").text();
        if(productos_unicos.indexOf(producto) === -1){
          productos_unicos.push(producto);
        }

      });
      $.each(productos_unicos, function(index, producto){
        var cantidad_total = 0;
        var precio_total = 0;
        $("#tblEstudios tbody tr").each(function(){
          var producto_actual = $(this).find("td:eq(1)").text();
          if(producto_actual === producto){
            cantidad_total += parseInt($(this).find("td:eq(2)").text());
            precio_total += parseFloat($(this).find("td:eq(6)").text());
          }
        });
        $("#tbltotales tbody").append("<tr><td>" + producto + "</td><td>" + cantidad_total + "</td><td>" + precio_total.toFixed(2) + "</td></tr>");
      });
                 // Obtener los totales de cada producto
var totales = [];
$("#tbltotales tbody tr").each(function(){
  totales.push(parseFloat((($(this).find("td:eq(2)").text())*100)/total2));
});


// Crear el gráfico de pastel
var grafico;
grafico = new Chart(document.getElementById('grafico'), {
  type: 'pie',
  data: {
    labels: productos_unicos,
    datasets: [{
      data: totales,
      backgroundColor: [
        '#fe958f',
        '#f3d7c2',
        '#8bb6a3',
        '#17a7a8',
        '#122f51',
        '#bd1550',
        // Agregar más colores aquí
      ],
    }],
  },
  options: {
    responsive: true,
  }
});
var canvas = document.getElementById('grafico');

// Ajustar el tamaño máximo del canvas
canvas.style.maxWidth = "500px";
canvas.style.maxHeight = "500px";
          });
  
});
document.addEventListener("DOMContentLoaded", function() {
  tblIngresos = $('#tblIngresos').DataTable({
    ajax: {
      url: 'http://localhost:8081/Hospital/Generales/filtrarfecha2',
      type: 'POST',
      data: function(d) {
        d.Fechain2 = $('#Fechain2').val();
        d.Fechater2 = $('#Fechater2').val();
      },
      dataSrc: 'data'
    },
    columns: [
      { data: 'Id_tipo' },
      { data: 'Nombre' },
      { data: 'cuota' },
      { data: 'Paciente' },
      { data: 'Fecha' },
      { data: 'acciones' }
    ],
    language: {
      // Configuración de idioma
    }
  });

  $('#btnfiltro2').on('click', function() {
    tblIngresos.ajax.reload();
  });

  $('#calcular').click(function() {
    var total = 0;
    tblIngresos.column(2).data().each(function(valor) {
      total += parseFloat(valor);
    });

    $('#Can').text('Cantidad de registros: ' + tblIngresos.data().length);

    $('#total').text('Total de ingresos: ' + total.toFixed(2));

    calcularPacientesPorProducto(total);

  function calcularPacientesPorProducto(total) {
    var productos_unicos2 = [];
    var producto2;
    $("#tblIngresos tbody tr").each(function() {
      producto2 = $(this).find("td:eq(1)").text();
      if (productos_unicos2.indexOf(producto2) === -1) {
        productos_unicos2.push(producto2);
      }
    });

    $("#tbltotal tbody").empty(); // Vaciar la tabla antes de actualizarla

    $.each(productos_unicos2, function(index, producto2) {
      var cantidad_total2 = 0;
      var precio_total2 = 0;
      var pacientes_unicos = {};

      $("#tblIngresos tbody tr").each(function() {
        var producto_actual2 = $(this).find("td:eq(1)").text();
        if (producto_actual2 === producto2) {
          cantidad_total2 += 1;
          precio_total2 += parseFloat($(this).find("td:eq(2)").text());
          var nombre_paciente = $(this).find("td:eq(3)").text().toLowerCase().trim();
          if (!pacientes_unicos[nombre_paciente]) {
            pacientes_unicos[nombre_paciente] = true;
          }
        }
      });

      var num_pacientes = Object.keys(pacientes_unicos).length;
      $("#tbltotal tbody").append("<tr><td>" + producto2 + "</td><td>" + cantidad_total2 + "</td><td>" + precio_total2.toFixed(2) + "</td><td>" + num_pacientes + "</td></tr>");
    });
  }
  var totales2 = [];
  $("#tbltotal tbody tr").each(function(){
    totales2.push(parseFloat((($(this).find("td:eq(2)").text())*100)/total));
  });
  
  
  // Crear el gráfico de pastel
  var grafico;
  grafico = new Chart(document.getElementById('grafico2'), {
    type: 'pie',
    data: {
      labels: productos_unicos2,
      datasets: [{
        data: totales2,
        backgroundColor: [
          '#fe958f',
          '#f3d7c2',
          '#8bb6a3',
          '#17a7a8',
          '#122f51',
          '#bd1550',
          // Agregar más colores aquí
        ],
      }],
    },
    options: {
      responsive: true,
    }
  });
  var canvas = document.getElementById('grafico2');
  
  // Ajustar el tamaño máximo del canvas
  canvas.style.maxWidth = "500px";
  canvas.style.maxHeight = "500px";
            });
          
});

function frmLogin(e) {
  e.preventDefault();
  const usuario = document.getElementById("usuario");
  const clave = document.getElementById("clave");
  if (usuario.value == "") {
    clave.classList.remove("is-invalid");
    usuario.classList.add("is-invalid");
    usuario.focus();
  } else if (clave.value == "") {
    usuario.classList.remove("is-invalid");
    clave.classList.add("is-invalid");
    clave.focus();
  } else {
    const url = "http://localhost:8081/Hospital/Usuarios/validar";
    const frm = document.getElementById("frmLogin");

    fetch(url, {
      method: 'POST',
      body: new FormData(frm)
    })
    .then(response => response.json())
    .then(data => {
      if (data === "ok") {
        window.location = "http://localhost:8081/Hospital/Usuarios";
      }
    })
    .catch(error => console.error(error));
  }
}
function frmEstudio(){
  document.getElementById("title").innerHTML = "Nuevo registro";
  document.getElementById("accion").innerHTML = "Guardar";
  $("#nuevo_registro").modal("show");

}
function frmFarmacia(){
  document.getElementById("title").innerHTML = "Nuevo medicamento";
  document.getElementById("accion").innerHTML = "Guardar";
  $("#nuevo_medicamento").modal("show");

}
function frmingreso(){
  document.getElementById("title").innerHTML = "Nuevo registro";
  document.getElementById("accion").innerHTML = "Guardar";
  $("#nuevo_ingreso").modal("show");

}
function registrarEstudio(e) {
  e.preventDefault();
  const Id_estudio = '';
  const Nombre = document.getElementById("Nombre");
  const Cantidad = document.getElementById("Cantidad");
  const Cuota = document.getElementById("Cuota");
  const Paciente = document.getElementById("Paciente");
  const Fecha = document.getElementById("Fecha");
  if (Cantidad.value == "" || Cuota.value == "" ||  Nombre.value == "" || Fecha.value == "" || Paciente.value == "" ) {
    Swal.fire({
      position: 'top',
      icon:'error',
      title: 'No puede haber campos vacios',
      showConfirmButton: false,
      timer: 3000
    })
  }
  else {
    const url = "http://localhost:8081/Hospital/Usuarios/registrar";
    const frm = document.getElementById("frmEstudio");
    const http = new XMLHttpRequest();
    http.open("POST",url,true);
    http.send(new FormData(frm));
    http.onreadystatechange = function (){
      if  (this.readyState == 4 && this.status == 200){
        console.log(this.responseText); 
           const res =JSON.parse(this.responseText);
           if(res == "si"){
            Swal.fire({
              position: 'top',
              icon:'success',
              title: 'Registro exitoso',
              showConfirmButton: false,
              timer: 3000
            })
            frm.reset();
            $("#nuevo_registro").modal("hide");
            location.reload();
            }else{
            Swal.fire({
              position: 'top',
              icon:'error',
              title: res,
              showConfirmButton: false,
              timer: 3000
            })
           }
      }

    }

    
  }
}
function registrarMedicamento(e) {
  e.preventDefault();
  const Nombre_Comercial = document.getElementById("Nombre_Comercial");
  const Descripcion = document.getElementById("Descripcion");
  const Cantidad = document.getElementById("Cantidad");
  const Precio = document.getElementById("Precio");
  if (Nombre_Comercial.value == "" || Descripcion.value == "" ||  Cantidad.value == "" || Precio.value == "" ) {
    Swal.fire({
      position: 'top',
      icon:'error',
      title: 'No puede haber campos vacios',
      showConfirmButton: false,
      timer: 3000
    })
  }
  else {
    const url = "http://localhost:8081/Hospital/Farmacia/registrarm";
    const frm = document.getElementById("frmFarmacia");
    const http = new XMLHttpRequest();
    http.open("POST",url,true);
    http.send(new FormData(frm));
    http.onreadystatechange = function (){
      if  (this.readyState == 4 && this.status == 200){
           console.log(this.responseText); 
           const res =JSON.parse(this.responseText);
           if(res == "si"){
            Swal.fire({
              position: 'top',
              icon:'success',
              title: 'Registro exitoso',
              showConfirmButton: false,
              timer: 3000
            })
            frm.reset();
            $("#nuevo_medicamento").modal("hide");
            location.reload();
            }else{
            Swal.fire({
              position: 'top',
              icon:'error',
              title: res,
              showConfirmButton: false,
              timer: 3000
            })
           }
      }

    }

    
  }
}
function btneliminar(ID){
  Swal.fire({
    title: 'Estas seguro de eliminar',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Eliminar',
    cancelButtonTetx: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) { 
    const url = "http://localhost:8081/Hospital/Usuarios/eliminar/"+ ID;
    const http = new XMLHttpRequest();
    http.open("GET",url,true);
    http.send();
    http.onreadystatechange = function (){
      if  (this.readyState == 4 && this.status == 200){
           console.log(this.responseText);
      }
    }  
      Swal.fire(
        'Eliminado!',
        'EL registro se ha eliminado',
        'success'
      )
    }
    location.reload();
  })
}
function beliminar(ID){
  Swal.fire({
    title: 'Estas seguro de eliminar',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Eliminar',
    cancelButtonTetx: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) { 
    const url = "http://localhost:8081/Hospital/Farmacia/eliminar/"+ ID;
    const http = new XMLHttpRequest();
    http.open("GET",url,true);
    http.send();
    http.onreadystatechange = function (){
      if  (this.readyState == 4 && this.status == 200){
           console.log(this.responseText);
      }
    }  
      Swal.fire(
        'Eliminado!',
        'EL registro se ha eliminado',
        'success'
      )
    }
    location.reload();
  })
}
function registraringreso(e) {
  e.preventDefault();
  const Id_tipo = '';
  const Nombre = document.getElementById("Nombre").value;
  const cuota = document.getElementById("cuota").value;
  const Paciente = document.getElementById("Paciente").value;
  const Fecha = document.getElementById("Fecha").value;
  if ( Nombre.value == "" || cuota.value == "" || Fecha.value == ""|| Paciente.value == "" ) {
    Swal.fire({
      position: 'top',
      icon:'error',
      title: 'No puede haber campos vacios',
      showConfirmButton: false,
      timer: 3000
    })
  }
  else {
    const url = "http://localhost:8081/Hospital/Generales/registrar";
    const frm = document.getElementById("frmingreso");
    const http = new XMLHttpRequest();
    http.open("POST",url,true);
    http.send(new FormData(frm));
    http.onreadystatechange = function (){
      if  (this.readyState == 4 && this.status == 200){
           console.log(this.responseText);
           const res =JSON.parse(this.responseText);
           if(res == "si"){
            Swal.fire({
              position: 'top',
              icon:'success',
              title: 'Registro exitoso',
              showConfirmButton: false,
              timer: 3000 
            })
            frm.reset();
            $("#nuevo.ingreso").modal("hide");
            location.reload();
            }else{
            Swal.fire({
              position: 'top',
              icon:'error',
              title: res,
              showConfirmButton: false,
              timer: 3000
            })
           }
      }

    }

    
  }
}
function eliminarflt(){
  location.reload();
}
function eliminaringreso(ID){
  if (ID) {
    Swal.fire({
      title: 'Estas seguro de eliminar',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Eliminar',
      cancelButtonTetx: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) { 
        const url = "http://localhost:8081/Hospital/Generales/eliminar/"+ ID;
        const http = new XMLHttpRequest();
        http.open("GET",url,true);
        http.send();
        http.onreadystatechange = function (){
          if  (this.readyState == 4 && this.status == 200){
            console.log(this.responseText);
            const res =JSON.parse(this.responseText);
          }
        }  
        Swal.fire(
          'Eliminado!',
          'EL registro se ha eliminado',
          'success'
        )
      }
      location.reload();
    })
  } else {
    console.log('ID no es un número válido');
  }
}

function frmfitro(){
  document.getElementById("title").innerHTML = "Filtro";
  $("#filtrofecha").modal("show");

}
function frmfitro2(){
  document.getElementById("title").innerHTML = "Filtro";
  $("#filtrofecha2").modal("show");

}

document.addEventListener("DOMContentLoaded", function(){
  tblMedicamentos = $('#tblMedicamentos').DataTable({
    ajax: {
      url: 'http://localhost:8081/Hospital/Farmacia/Listar',
      type: 'POST',
      dataSrc: 'data'
      
        },
    columns: [
      { data: 'Id_registro' },
      { data: 'Nombre_Comercial' },
      { data: 'Descripcion' },
      {
        data: 'Cantidad',
        render: function(data, type, row) {
          return '<button class="btn btn-sm btn-success ml-2" onclick="incrementarCantidad(' + row.Id_registro + ')"><i class="fa fa-plus"></i></button>' + 
                 '<button class="btn btn-sm btn-danger ml-2" onclick="DisminuirCantidad(' + row.Id_registro + ')"><i class="fa fa-minus"></i></button>' +
                 '<span class="ml-2">' + data + '</span>';
        }
      },
      
      { data: 'Precio' },
      { data: 'acciones'}
    ],
    language: {
      "sProcessing": "Procesando...",
      "sLengthMenu": "Mostrar _MENU_ registros",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "Ningún dato disponible en esta tabla",
      "sInfo": "Mostrando registros  _START_ ... _END_  total _TOTAL_ registros",
      "sInfoEmpty": "Mostrando registros 0 - 0  total de 0 registros",
      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix": "",
      "sSearch": "Buscar:&nbsp;",
      "sUrl": "",
      "sInfoThousands": ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "&nbsp;Siguiente",
        "sPrevious": "Anterior&nbsp;"
      },
      "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      },
      "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad"
      }
    }
    
  });

});
function mostrarMedicamentosMenosDeCinco() {
  // Realiza una petición AJAX al servidor para obtener los medicamentos que tienen una cantidad menor a 5
  $.ajax({
    type: "POST",
    url: "http://localhost:8081/Hospital/Farmacia/Medi",
    success: function(data) {
      // Extrae los datos de la respuesta y convierte la cadena JSON en un objeto JavaScript
      var response = JSON.parse(data);
      var medicamentos = response.data;
      
      // Crea una tabla con los medicamentos obtenidos y muéstrala en un cuadro emergente
      var tabla = "<table>";
      tabla += "<thead><tr><th>Nombre  </th><th>Cantidad</th></tr></thead>";
      tabla += "<tbody>";
      for (var i = 0; i < medicamentos.length; i++) {
        tabla += "<tr>";
        tabla += "<td>" + medicamentos[i].Nombre_Comercial + "</td>";
        tabla += "<td>" + medicamentos[i].Cantidad + "</td>";
        tabla += "</tr>";
      }
      tabla += "</tbody></table>";

      // Muestra la tabla en un cuadro emergente usando SweetAlert2
      Swal.fire({
        title: "Están por agotarse:",
        html: tabla
      });
    }
  });
}
function ticket(){
  // Realiza una petición AJAX al servidor para obtener los medicamentos que tienen una cantidad menor a 5
  $.ajax({
    type: "POST",
    url: "http://localhost:8081/Hospital/Generales/total",
    data: { Paciente: $('#Paciente').val() },
    success: function(data) {
      // Extrae los datos de la respuesta y convierte la cadena JSON en un objeto JavaScript
      var response = JSON.parse(data);
      var ingresos = response.data;
      // Crea una tabla con los medicamentos obtenidos y muéstrala en un cuadro emergente
      var totalCuotas = 0;
      for (var i = 0; i < ingresos.length; i++) {
        totalCuotas += parseFloat(ingresos[i].cuota);
      }
      var tabla = "<table>";
      tabla += "<thead><tr><th>-Tipo de ingreso-</th><th>--Cuota--</th></tr></thead>";
      tabla += "<tbody>";
      for (var i = 0; i <  ingresos.length; i++) {
        tabla += "<tr>";
        tabla += "<td>" +  ingresos[i].Nombre + "</td>";
        tabla += "<td>" +  ingresos[i].cuota + "</td>";
        tabla += "</tr>";

      }
      tabla += "</tbody></table>";

      // Muestra la tabla en un cuadro emergente usando SweetAlert2
      Swal.fire({
        title: "Resumen de pago",
        html: tabla + "<p>Total a pagar: " + totalCuotas.toFixed(2) + "</p>"
      });
    }
  });
}
function actualizarCuota() {
  var select = document.getElementById("Nombre");
  var idEstudio = select.value;
  var cuotaInput = document.getElementById("Cuota");

  // Realiza una petición AJAX al servidor para obtener la cuota correspondiente al estudio seleccionado
  $.ajax({
    type: "POST",
    url: "http://localhost:8081/Hospital/Usuarios/Cuota/"+idEstudio,

    data: {idEstudio: idEstudio},
    success: function(cuota) {
      // Actualiza el valor del input de cuota con la cuota obtenida
      cuotaInput.value = cuota;
    }
  });
}
function beditar(ID){
  document.getElementById("title").innerHTML = "Editar medicamento";
  document.getElementById("accion").innerHTML = "Guardar";
  const url = "http://localhost:8081/Hospital/Farmacia/editar/"+ ID;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function (){
    if (this.readyState === 4 && this.status === 200) {
         const res =JSON.parse(this.responseText);
         if (res && res.length > 0) {
          const medicamento = res[0];
          console.log(medicamento);
          document.getElementById("id").value = medicamento.Id_registro;
          document.getElementById("Nombre_Comercial").value = medicamento.Nombre_Comercial;
          document.getElementById("Descripcion").value = medicamento.Descripcion;
          document.getElementById("Cantidad").value = medicamento.Cantidad;
          document.getElementById("Precio").value = medicamento.Precio;
          $("#nuevo_medicamento").modal("show");
      }
      
    }
  }
}
function incrementarCantidad(id) {
  $.ajax({
    url: 'http://localhost:8081/Hospital/Farmacia/IncrementarCantidad/' + id,
    type: 'POST',
    success: function(result) {
      tblMedicamentos.ajax.reload();
    }
  });
}

function DisminuirCantidad(id) {
  $.ajax({
    url: 'http://localhost:8081/Hospital/Farmacia/DisminuirCantidad/' + id,
    type: 'POST',
    success: function(result) {
      tblMedicamentos.ajax.reload();
    }
  });
}
function logout() {
  $.ajax({
    url: 'http://localhost:8081/Hospital/Usuarios/Logout',
    type: 'POST',
    success: function(result) {
      window.location.href = 'http://localhost:8081/Hospital/';
    }
  });
}



