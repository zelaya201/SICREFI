
$(document).ready(function () {

  /* EVENTO DE BOTONES */
  $('#btn-agregar-telefono').click(function () {
    var id = 0;
    var dato = $('#input-telefono').val();

    if (sessionStorage.getItem("size") !== null) {
      id = sessionStorage.getItem("size");
    }

    if(dato !== '') {
      if(verificarTelefono(dato)) {
        $('#input-telefono').removeClass('is-invalid');
        sessionStorage.setItem("r" + id, JSON.stringify(dato));
        sessionStorage.setItem("size", parseInt(id) + 1);
        telefonosList();
      }else{
        $('#input-telefono').addClass('is-invalid');
        $('#mensaje-telefono').html('El teléfono ya existe.');
      }
    }else{
      $('#input-telefono').addClass('is-invalid');
      $('#mensaje-telefono').html('El campo es requerido.');
    }
  });
});

/* FUNCIONES GLOBALES */
function telefonosList() {
  var html = '';

  if (sessionStorage.getItem("size") !== null) {
    var size = sessionStorage.getItem("size");
    for (var i = 0; i < size; i++) {
      if(sessionStorage.getItem("r" + i) !== null) {
        var dato = JSON.parse(sessionStorage.getItem("r" + i));
        html += "<tr>";
        html += "<td>" + dato + "</td>";
        html += "<td>" +
            "<button type='button' class='btn btn-outline-danger btn-sm' onclick='borrarTelefono(" + i + ")'>" +
              "<i class='tf-icons bx bx-trash'></i>" +
            "</button>" +
          "</td>";
        html += "</tr>";
      }
    }
  }

  if (html === ''){
    html += '<tr>' +
      '<td colspan="2">No hay resultados</td>' +
      '</tr>';
  }

  $('#lista-telefonos').html(html);
  $('#telefono-modal').modal('hide');
  $('#input-telefono').val('');
}

function borrarTelefono(id) {
  sessionStorage.removeItem("r" + id);
  telefonosList();
}

function verificarTelefono(telefono){
  var size = sessionStorage.getItem("size");
  for (var i = 0; i < size; i++) {
    if(sessionStorage.getItem("r" + i) !== null) {
      var dato = JSON.parse(sessionStorage.getItem("r" + i));
      if(dato === telefono){
        return false;
      }
    }
  }
  return true;
}


