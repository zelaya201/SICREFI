@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Nuevo Crédito')

@section('page-style')
  <link href="https://cdn.jsdelivr.net/gh/mobius1/selectr@latest/dist/selectr.min.css" rel="stylesheet" type="text/css">
  <style>
    .selectr-selected {
      border: 1px solid #ced4da;
    }
  </style>
@endsection

@section('content')
  <form action="{{ route('creditos.store') }}" method="post" autocomplete="off" enctype="multipart/form-data"
        id="form-credito">
    @csrf

    <div class="d-flex align-items-center justify-content-between py-3">
      <div class="flex-grow-1">
        <div
          class="d-flex align-items-center justify-content-md-between justify-content-start flex-md-row flex-column gap-4">
          <div class="user-profile-info">
            <h4 class="fw-bold m-0"><span class="text-muted fw-light">Créditos /</span> Nuevo Crédito</h4>
          </div>
          <ul
            class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
            <li class="list-inline-item fw-semibold">
              <button type="button" class="btn rounded-pill btn-icon btn-warning"
                      data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd" aria-controls="offcanvasEnd"
                      data-bs-offset="0,4"
                      data-bs-placement="top" data-bs-html="true" title="Ayuda">
                <span class="tf-icons bx bx-question-mark"></span>
              </button>
            </li>
            <li class="list-inline-item fw-semibold">

              <button class="nav-link btn btn-primary" type="button" id="btn_guardar_credito">
                <span class="tf-icons bx bx-save"></span>
                Realizar crédito
              </button>
            </li>
            <li class="list-inline-item fw-semibold">
              <a class="nav-link btn btn-secondary" type="button" href="{{ route('creditos.index') }}"> Cancelar
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    @include('content.creditos.form')

  </form>

@endsection

@section('page-script')

  <script src="{{ asset('assets/js/cliente.js') }}"></script>
  {{-- Bootstrap select --}}
  <!-- MDB -->

  <script src="https://cdn.jsdelivr.net/gh/mobius1/selectr@latest/dist/selectr.min.js" type="text/javascript"></script>
  {{-- Select2 --}}


  <script>
    var check_nuevo = $('#check_nuevo');
    var check_renovacion = $('#check_renovacion');
    var check_refinan = $('#check_refinan');

    var input_monto = $('#monto_neto_credito');
    var input_tasa_interes = $('#tasa_interes_credito');
    var input_n_cuotas = $('#n_cuotas_credito');
    var input_monto_pagar = $('#monto_credito');
    var input_desembolso = $('#desembolso_credito');
    var input_deuda = $('#deuda_credito');
    var input_monto_cuota = $('#monto_cuota_credito');
    var input_fecha_primer_cuota = $('#fech_primer_cuota');

    var select_frecuencia_pago = $('#frecuencia_credito');

    var form_credito = $('#form-credito');

    var tabla_cuotas = $('#lista_cuotas');

    var modal_cuotas = $('#modal_cuotas');

    var btn_guardar_credito = $('#btn_guardar_credito');
    var btn_calcular_cuotas = $('#btn_calcular_cuotas');

    var select_id_cliente = new Selectr('#id_cliente', {
      searchable: true,
      placeholder: 'Seleccione un cliente',
      messages: {
        noResults: 'No se encontraron resultados',
        noOptions: 'No hay clientes disponibles'
      }
    });

    var select_id_credito = new Selectr('#id_credito', {
      searchable: true,
      placeholder: 'Seleccione un crédito',
      messages: {
        noResults: 'No se encontraron resultados',
        noOptions: 'No hay créditos disponibles'
      }
    });
    var select_bienes = new Selectr('#id_bien', {
      searchable: true,
      multiple: true,
      serialize: true,
      getValue: true,
      placeholder: 'Seleccione un bien',
      messages: {
        noResults: 'No se encontraron resultados',
        noOptions: 'No hay bienes disponibles'
      }
    });

    $(document).ready(function () {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
      });

      btn_guardar_credito.on('click', function (){
        // Registrar credito
        $.ajax({
          url: '{{ route("creditos.store") }}',
          type: 'post',
          dataType: 'json',
          data: form_credito.serialize() + '&bienes=' + select_bienes.getValue(),
          success: function (data) {
            if(data.success){
              window.location.href = '{{ route("creditos.index") }}';
            }
          }
        });
      });

      btn_calcular_cuotas.on('click', function () {
        calcularPlanPagos();
      });

      input_monto.on('input', function () {
        calcularMontonPagar();
      });

      input_tasa_interes.on('input', function () {
        calcularMontonPagar();
      });

      input_n_cuotas.on('input', function () {
        calcularMontonPagar();
      });

      select_frecuencia_pago.on('change', function () {
        calcularMontonPagar();
      });
    });

    select_id_cliente.on('selectr.select', function () {
      let id_cliente_selected = select_id_cliente.getValue();
      if (id_cliente_selected !== '') {
        cargarBienesSelect(id_cliente_selected);

        if(check_nuevo.checked === false){
          cargarCreditosSelect(id_cliente_selected);
        }
      }
    });

    function cargarCreditosSelect(id_cliente_selected){
      $.ajax({
        url: "{{ route('creditos.get' , ':id')}}" .replace(':id', id_cliente_selected),
        type: 'GET',
        data: {
          id: id_cliente_selected
        },
        success: function (data) {
          select_id_credito.removeAll();
          data.forEach(function (element) {
            select_id_credito.add({
              value: element.id_credito,
              text: element.tipo_credito + ' - ' + element.monto_credito
            });
          });
        }
      });
    }

    function cargarBienesSelect(id_credito_selected){
      $.ajax({
        url: "{{ route('bienes.get' , ':id')}}" .replace(':id', id_credito_selected),
        type: 'GET',
        data: {
          id: id_credito_selected
        },
        success: function (data) {
          select_bienes.removeAll();
          data.forEach(function (element) {
            select_bienes.add({
              value: element.id_bien,
              text: element.nom_bien
            });
          });
        }
      });
    }

    function calcularMontonPagar(){
      let monto_credito = input_monto.val();
      let tasa_interes = input_tasa_interes.val();
      let n_cuotas = input_n_cuotas.val();
      let frecuencia_pago = select_frecuencia_pago.val();
      let deuda = input_deuda.val();

      input_monto_pagar.val('0.00');
      input_desembolso.val('0.00');
      input_monto_cuota.val('0.00');

      if (monto_credito !== '' && tasa_interes !== '' && n_cuotas !== '' && frecuencia_pago !== '') {
        let monto_interes = monto_credito * tasa_interes;
        let monto_total = parseFloat(monto_credito) + monto_interes + parseFloat(deuda);
        let desembolso = parseFloat(monto_credito) - parseFloat(deuda);
        input_monto_pagar.val(monto_total.toFixed(2));
        input_desembolso.val(desembolso.toFixed(2));
        input_monto_cuota.val((monto_total / n_cuotas).toFixed(2));
      }
    }

    function calcularPlanPagos(){
      let monto_credito = input_monto.val();
      let tasa_interes = input_tasa_interes.val();
      let n_cuotas = input_n_cuotas.val();
      let fecha_primer_cuota = input_fecha_primer_cuota.val();
      let frecuencia_pago = select_frecuencia_pago.val();

      let monto_interes = monto_credito * tasa_interes / n_cuotas;
      let monto_cuota = parseFloat(monto_credito) / n_cuotas;
      let monto_total = monto_cuota + monto_interes;

      tabla_cuotas.empty();

      for (let i = 0; i < n_cuotas; i++) {

        let fecha_cuota = changeTimezone(new Date(fecha_primer_cuota));

        // if(frecuencia_pago === 'Diario') {
        //   fecha_cuota.setDate(fecha_cuota.getDate() + i);
        // } else if (frecuencia_pago === 'Semanal') {
        //   fecha_cuota.setDate(fecha_cuota.getDate() + (i * 7));
        // } else if (frecuencia_pago === 'Quincenal') {
        //   fecha_cuota.setDate(fecha_cuota.getDate() + (i * 15));
        // } else if (frecuencia_pago === 'Mensual') {
        //   fecha_cuota.setMonth(fecha_cuota.getMonth() + i);
        // }

        let row = '<tr>' +
          '<td>' + (i + 1) + '</td>' +
          '<td>' + fecha_cuota + '</td>' +
          '<td>' + monto_cuota.toFixed(2) + '</td>' +
          '<td>' + monto_interes.toFixed(2) + '</td>' +
          '<td>' + monto_total.toFixed(2) + '</td>' +
          '</tr>';

        tabla_cuotas.append(row);
      }

      modal_cuotas.modal('show');
    }

    function parseDate(date){
      let d = new Date(date);
      let day = d.getDate();
      let month = d.getMonth() + 1;
      let year = d.getFullYear();
      return day + '/' + month + '/' + year;
    }

    function changeTimezone(fecha) {
      let formatter = new Intl.DateTimeFormat('es-SV', {timeZone: 'America/El_Salvador'});
      return formatter.format(fecha);
    }
  </script>

@endsection
