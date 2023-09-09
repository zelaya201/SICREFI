
$(document).ready(function () {

  sessionStorage.clear();

  /* EVENTO DE BOTONES */
  $('#btn-agregar-telefono-cliente').click(function () {
    var id = 0;
    var dato = $('#input-telefono-cliente').val();

    if (sessionStorage.getItem("size") !== null) {
      id = sessionStorage.getItem("size");
    }

    if(dato !== '') {
      if(verificarTelefono(dato)) {
        $('#input-telefono-cliente').removeClass('is-invalid');
        sessionStorage.setItem("r" + id, JSON.stringify(dato));
        sessionStorage.setItem("size", parseInt(id) + 1);
        telefonosList();
      }else{
        $('#input-telefono-cliente').addClass('is-invalid');
        $('#mensaje-telefono-cliente').html('El teléfono ya existe.');
      }
    }else{
      $('#input-telefono-cliente').addClass('is-invalid');
      $('#mensaje-telefono-cliente').html('El campo es requerido.');
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

  $('#lista-telefonos-cliente').html(html);
  $('#telefono-modal-cliente').modal('hide');
  $('#input-telefono-cliente').val('');
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


