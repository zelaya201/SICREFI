var check_nuevo = $('#check_nuevo');
var check_renovacion = $('#check_renovacion');
var check_refinan = $('#check_refinan');

var input_monto = $('#monto_neto_credito');
var input_tasa_interes = $('#tasa_interes_credito');
var input_n_cuotas = $('#n_cuotas_credito');
var input_monto_pagar = $('.monto_credito');
var input_desembolso = $('.desembolso_credito');
var input_deuda = $('.deuda_credito');
var input_monto_cuota = $('.monto_cuota_credito');
var input_fecha_primer_cuota = $('#fech_primer_cuota');
var input_credito = $('#input_credito');
var input_id_credito = $('#id_credito');

var select_frecuencia_pago = $('#frecuencia_credito');

var form_credito = $('#form-credito');

var tabla_cuotas = $('#datos_cuotas');

var btn_guardar_credito = $('#btn_guardar_credito');

var select_id_cliente = new Selectr('#id_cliente', {
  searchable: true,
  placeholder: 'Seleccione un cliente',
  customClass: 'is-invalid',
  messages: {
    noResults: 'No se encontraron resultados',
    noOptions: 'No hay clientes disponibles'
  }
});

var select_id_cliente_label = $('#id_cliente_label');

var select_bienes = new Selectr('#bienes', {
  searchable: true,
  multiple: true,
  serialize: true,
  getValue: true,
  customClass: 'is-invalid',
  placeholder: 'Seleccione los bienes',
  messages: {
    noResults: 'No se encontraron resultados',
    noOptions: 'No hay bienes disponibles'
  }
});

var select_ref = new Selectr('#referencias', {
  searchable: true,
  multiple: true,
  serialize: true,
  getValue: true,
  customClass: 'is-invalid',
  placeholder: 'Seleccione las referencias',
  messages: {
    noResults: 'No se encontraron resultados',
    noOptions: 'No hay referencias disponibles'
  }
});

var select_negocio = new Selectr('#id_negocio', {
  searchable: true,
  placeholder: 'Seleccione un negocio',
  customClass: 'is-invalid',
  messages: {
    noResults: 'No se encontraron resultados',
    noOptions: 'No hay negocios disponibles'
  }
});

select_bienes.removeAll();
select_ref.removeAll();

var credito_seleccionado = null;
var cliente_selected = null;

$(document).ready(function () {
  var inputs = form_credito.find('input, select, textarea, checkbox');

  inputs.change(function () {
    $(this).removeClass('is-invalid'); //Eliminar clase 'is-invalid'
  });

  select_id_cliente.on('selectr.change', function () {
    $('#id_cliente_error').html('');
  });

  select_bienes.on('selectr.change', function () {
    $('#bienes_error').html('');
  });

  select_ref.on('selectr.change', function () {
    $('#referencias_error').html('');
  });

  select_negocio.on('selectr.change', function () {
    $('#id_negocio_error').html('');
  });

  input_monto.on('input', function () {
    if(check_refinan.is(':checked') === true){
      check_renovacion.prop('checked', true);
      check_refinan.prop('checked', false);
    }

    calcularMontonPagar();
    calcularPlanPagos()
  });

  input_tasa_interes.on('input', function () {
    calcularMontonPagar();
    calcularPlanPagos();
  });

  input_n_cuotas.on('input', function () {
    calcularMontonPagar();
    calcularPlanPagos();
  });

  select_frecuencia_pago.on('change', function () {
    calcularMontonPagar();
    calcularPlanPagos();
  });

  input_fecha_primer_cuota.on('change', function () {
    calcularPlanPagos();
  });

  check_nuevo.on('click', function () {
    input_credito.html('Información no disponible');
    input_deuda.val('0.00');
    calcularMontonPagar();
  });

  check_renovacion.on('click', function () {
    if(select_id_cliente.getValue() !== '') {
      cargarCredito();
    }
  });

  check_refinan.on('click', function () {
    if(select_id_cliente.getValue() !== '') {
      cargarCredito();
    }
  });

  select_id_cliente.on('selectr.select', function () {
    let id_cliente_selected = select_id_cliente.getValue();
    cliente_selected = JSON.parse(id_cliente_selected);

    // Si tiene credito vigente
    if(cliente_selected.credito !== null){
      credito_seleccionado = cliente_selected.credito;
      check_nuevo.prop('checked', false).prop('disabled', true);
      check_renovacion.prop('disabled', true);

      if(credito_seleccionado.renovacion){
        check_renovacion.prop('disabled', false);
        check_renovacion.prop('checked', true);
        check_refinan.prop('disabled', true);
      }else{
        input_monto.prop('readonly', true);
        check_refinan.prop('checked', true);
        check_refinan.prop('disabled', false);
      }

    }else{
      input_monto.prop('readonly', false);
      check_nuevo.prop('checked', true).prop('disabled', false)
      check_refinan.prop('disabled', true);
      check_renovacion.prop('disabled', true);
    }

    input_deuda.val('0.00');
    input_deuda.html('0.00');

    if (id_cliente_selected !== '') {
      cargarBienesSelect();

      if (check_nuevo.is(':checked') !== true) {
        if(check_renovacion.is(':checked') === true || check_refinan.is(':checked') === true) {
          cargarCredito();
        }
      }else{
        input_credito.html('Información no disponible');
      }

      cargarReferenciasSelect();
      cargarNegocioSelect();
    }

    calcularPlanPagos();
    calcularMontonPagar();
  });
});

function cargarCredito() {
  if (cliente_selected !== null){
    credito_seleccionado = cliente_selected.credito;

    let html =
      '<div class="col-md-12">' +
        'N° de crédito: ' + credito_seleccionado.id_credito +
       '</div>' +
      '<div class="col-md-12">' +
        'Total a pagar: $' + credito_seleccionado.monto_credito.toFixed(2) +
      '</div>' +
      '<div class="col-md-12">' +
        'Deuda total: $' + credito_seleccionado.deuda_credito.toFixed(2) +
      '</div>';

    if(credito_seleccionado.estado_credito === 'Vigente'){
      html +=
        '<div class="col-md-12">' +
          'Estado: <span class="badge bg-label-success">' + credito_seleccionado.estado_credito + '</span>' +
        '</div>';
    }else{
      html +=
        '<div class="col-md-12">' +
          'Estado: <span class="badge bg-label-danger">' + credito_seleccionado.estado_credito + '</span>' +
        '</div>';
    }

    input_credito.html(html);
    input_id_credito.val(credito_seleccionado.id_credito);

    cargarDatosCredito();
    calcularMontonPagar();
  }
}

function cargarDatosCredito(){
  input_deuda.val(credito_seleccionado.deuda_credito.toFixed(2));
  input_deuda.html(credito_seleccionado.deuda_credito.toFixed(2));

  input_monto.val(credito_seleccionado.deuda_credito.toFixed(2));

  if(check_refinan.is(':checked') !== true){
    input_monto.val(credito_seleccionado.monto_neto_credito.toFixed(2));
  }

  input_tasa_interes.val(credito_seleccionado.tasa_interes_credito.toFixed(4));
  input_n_cuotas.val(credito_seleccionado.n_cuotas_credito);
  select_frecuencia_pago.val(credito_seleccionado.frecuencia_credito);
}

function cargarBienesSelect() {
  select_bienes.removeAll();
  cliente_selected.bienes.forEach(function (element) {
    select_bienes.add({
      value: element.id_bien,
      text: element.nom_bien
    });
  });

  if(credito_seleccionado !== null){
    credito_seleccionado.bienes.forEach(function (element) {
      select_bienes.setValue(element.id_bien);
    });
  }
}

function cargarReferenciasSelect() {
  select_ref.removeAll();
  cliente_selected.referencias.forEach(function (element) {
    select_ref.add({
      value: element.id_ref,
      text: element.primer_nom_ref + ' ' + element.primer_ape_ref
    });
  });

  if(credito_seleccionado !== null){
    credito_seleccionado.referencias.forEach(function (element) {
      select_ref.setValue(element.id_ref);
    });
  }
}

function cargarNegocioSelect() {
  select_negocio.removeAll();
  cliente_selected.negocios.forEach(function (element) {
    select_negocio.add({
      value: element.id_negocio,
      text: element.nom_negocio
    });
  });

  if(credito_seleccionado !== null){
    select_negocio.setValue(credito_seleccionado.id_negocio);
  }
}

function calcularMontonPagar() {
  let monto_credito = input_monto.val();
  let tasa_interes = input_tasa_interes.val();
  let n_cuotas = input_n_cuotas.val();
  let frecuencia_pago = select_frecuencia_pago.val();
  let deuda = input_deuda.val();

  input_monto_pagar.val('0.00');
  input_desembolso.val('0.00');
  input_monto_cuota.val('0.00');

  input_monto_pagar.html('0.00');
  input_desembolso.html('0.00');
  input_monto_cuota.html('0.00');

  if (monto_credito !== '' && tasa_interes !== '' && n_cuotas !== '' && frecuencia_pago !== '') {
    let monto_interes = monto_credito * (tasa_interes / 100);
    let monto_total = parseFloat(monto_credito) + monto_interes;
    let desembolso = parseFloat(monto_credito) - parseFloat(deuda);

    input_monto_pagar.val(monto_total.toFixed(2));
    input_desembolso.val(desembolso.toFixed(2));
    input_monto_cuota.val((monto_total / n_cuotas).toFixed(2));

    input_monto_pagar.html(monto_total.toFixed(2));
    input_desembolso.html(desembolso.toFixed(2));
    input_monto_cuota.html((monto_total / n_cuotas).toFixed(2));
  }
}

function parseDate(date) {
  let d = new Date(date);
  let day = d.getDate();
  let month = parseMonth(d.getMonth() + 1);
  let year = d.getFullYear();
  return day + ' de ' + month + ' de ' + year;
}

function parseMonth(month) {
  switch (month) {
    case 1:
      return 'Ene';
    case 2:
      return 'Feb';
    case 3:
      return 'Mar';
    case 4:
      return 'Abr';
    case 5:
      return 'May';
    case 6:
      return 'Jun';
    case 7:
      return 'Jul';
    case 8:
      return 'Ago';
    case 9:
      return 'Sep';
    case 10:
      return 'Oct';
    case 11:
      return 'Nov';
    case 12:
      return 'Dic';
  }
}

function limpiarTablaCuotas() {
  tabla_cuotas.empty();
  tabla_cuotas.append('<tr>' +
    '<td colspan="5" class="text-center">No hay cuotas disponibles</td>' +
    '</tr>');
}
