@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Nuevo Crédito')

@section('page-style')
  <link href="{{ asset('assets/css/selectr.min.css') }}" rel="stylesheet" type="text/css">
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

    <div class="alert alert-danger d-none m-0 mt-3" role="alert" id="alerta-error">
      <span class="badge badge-center rounded-pill bg-danger border-label-danger p-3 me-2" id="label-error"><i
          class="bx bx-error fs-6"></i></span>
      <div class="d-flex flex-column">
        <h6 class="alert-heading d-flex align-items-center mb-1">Mensaje de alerta</h6>
        <span id="mensaje_error"></span>
      </div>
    </div>

    @include('content.creditos.form')

  </form>

@endsection

@section('page-script')
  <script src="{{ asset('assets/js/selectr.min.js') }}"></script>

  <script src="{{ asset('assets/js/cliente.js') }}"></script>

  <script src="{{ asset('assets/js/credito.js') }}"></script>

  <script>
    $(document).ready(function () {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
      });

      /* ############################################ */
      btn_guardar_credito.on('click', function () {
        // REGISTRAR CRÉDITO

        $.ajax({
          url: '{{ route("creditos.store") }}',
          type: 'post',
          dataType: 'json',
          data: form_credito.serialize()
            + '&bienes=' + select_bienes.getValue()
            + '&referencias=' + select_ref.getValue()
            + '&id_cliente=' + (cliente_selected === null ? '' : cliente_selected.id_cliente),
          success: function (data) {
            if (data.success) {
              window.location.href = '{{ route("creditos.index") }}';
            }
          },
          error: function (xhr) {
            var data = xhr.responseJSON;

            if ($.isEmptyObject(data.errors) === false) {
              $.each(data.errors, function (key, value) {
                // Mostrar errores en los inputs
                $('#' + key).addClass('is-invalid');
                $('#' + key + '_error').html(value); // Agregar el mensaje de error
                if(key === 'id_cliente') {
                  $('#id_cliente-label').addClass('border border-danger rounded');
                }
              });
            }
          }
        });
      });
      /* ############################################ */
    });

    function calcularPlanPagos() {
      let monto_credito = input_monto.val();
      let tasa_interes = input_tasa_interes.val();
      let n_cuotas = input_n_cuotas.val();
      let fecha_primer_cuota = input_fecha_primer_cuota.val();
      let frecuencia_pago = select_frecuencia_pago.val();

      if (monto_credito === '' || tasa_interes === '' || n_cuotas === '' || fecha_primer_cuota === '' || frecuencia_pago === '') {
        limpiarTablaCuotas();
        return;
      }

      let monto_interes = monto_credito * (tasa_interes / 100) / n_cuotas;
      let monto_cuota = parseFloat(monto_credito) / n_cuotas;
      let monto_total = monto_cuota + monto_interes;

      $.ajax({
        url: "{{ route('creditos.calcularFechasCuotas') }}",
        type: 'GET',
        dataType: 'json',
        data: {
          n_cuotas_credito: n_cuotas,
          fech_primer_cuota: fecha_primer_cuota,
          frecuencia_credito: frecuencia_pago
        },
        success: function (data) {

          tabla_cuotas.empty();
          let i = 1;
          data.forEach(function (element) {
            tabla_cuotas.append(
              '<tr>' +
              '<td>' + i + '</td>' +
              '<td>' + parseDate(new Date(element.date)) + '</td>' +
              '<td>$' + monto_cuota.toFixed(2) + '</td>' +
              '<td>$' + monto_interes.toFixed(2) + '</td>' +
              '<td>$' + monto_total.toFixed(2) + '</td>' +
              '</tr>'
            );

            i++;
          });
        }
      });
    }

  </script>

@endsection
