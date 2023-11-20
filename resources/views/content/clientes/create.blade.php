@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Nuevo Cliente')
@section('content')
  <form action="{{ route('clientes.store') }}" method="post" autocomplete="off" enctype="multipart/form-data"
        id="form-cliente">

    <div class="d-flex align-items-center justify-content-between py-3">
      <div class="flex-grow-1">
        <div
          class="d-flex align-items-center justify-content-md-between justify-content-start flex-md-row flex-column gap-4">
          <div class="user-profile-info">
            <h4 class="fw-bold m-0"><span class="text-muted fw-light">Clientes /</span> Nuevo Cliente</h4>
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

              <button class="nav-link btn btn-primary load" type="button" id="btn-guardar-cliente">
                <span class="tf-icons bx bx-save"></span>
                Guardar cliente
              </button>
            </li>
            <li class="list-inline-item fw-semibold load">
              <a class="nav-link btn btn-secondary" type="button" href="{{ route('clientes.index') }}"> Cancelar
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    {{-- Navegación de Formulario --}}
    {{--  <ul class="nav nav-pills nav-align-left nav-card-header-pills align-items-center" role="tablist">--}}
    <ul class="nav nav-pills nav-align-left nav-card-header-pills align-items-center" role="tablist">
      <li class="nav-item" role="presentation">
        <button type="button" class="btn nav-link active" role="tab" data-bs-toggle="tab" id="item-cliente"
                data-bs-target="#card-cliente" aria-controls="card-cliente" aria-selected="true">

          <i class="bx bx-user"></i> Cliente
          <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger ms-1 d-none"
                id="cant-errores-cliente"></span>
        </button>
      </li>
      <li>
        <div class="line d-none d-md-inline-block align-items-baseline">
          <i class="bx bx-chevron-right"></i>
        </div>
      </li>
      <li class="nav-item" role="presentation">
        <button type="button" class="btn nav-link disabled" role="tab" data-bs-toggle="tab"
                id="item-conyuge"
                data-bs-target="#card-conyuge"
                aria-controls="card-conyuge" aria-selected="false">
          <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger ms-1 d-none"
                id="cant-errores-conyuge"></span>
          <i class="bx bx-user-check"></i> Conyuge
        </button>
      </li>
      <li>
        <div class="line d-none d-md-inline-block align-items-baseline">
          <i class="bx bx-chevron-right"></i>
        </div>
      </li>
      <li class="nav-item" role="presentation">
        <button type="button" class="btn nav-link disabled" role="tab" data-bs-toggle="tab"
                data-bs-target="#card-negocios"
                id="item-negocios"
                aria-controls="card-negocios" aria-selected="false">
          <i class="tf-icons bx bx-store-alt"></i> Negocios
        </button>
      </li>
      <li>
        <div class="line d-none d-md-inline-block align-items-baseline">
          <i class="bx bx-chevron-right"></i>
        </div>
      </li>
      <li class="nav-item" role="presentation">
        <button type="button" class="btn nav-link disabled" role="tab" data-bs-toggle="tab"
                data-bs-target="#card-referencia"
                id="item-referencia"
                aria-controls="card-referencia" aria-selected="false">
          <i class="bx bx-user-plus"></i> Referencias
        </button>
      </li>
      <li>
        <div class="line d-none d-md-inline-block align-items-baseline">
          <i class="bx bx-chevron-right"></i>
        </div>
      </li>
      <li class="nav-item" role="presentation">
        <button type="button" class="btn nav-link disabled" role="tab" data-bs-toggle="tab"
                data-bs-target="#card-bienes"
                id="item-bienes"
                aria-controls="card-bienes" aria-selected="false">
          <i class="bx bx-buildings"></i> Bienes
        </button>
      </li>
    </ul>

    <div class="alert alert-danger d-none m-0 mt-3" role="alert" id="alerta-error">
      <span class="badge badge-center rounded-pill bg-danger border-label-danger p-3 me-2" id="label-error"><i
          class="bx bx-error fs-6"></i></span>
      <div class="d-flex flex-column">
        <h6 class="alert-heading d-flex align-items-center mb-1">Mensaje de alerta</h6>
        <span id="mensaje-error">¡Debe agregar al menos un teléfono al cliente!</span>
      </div>
    </div>

    <div class="tab-content p-0">
      @include('content.clientes._partials.form') {{-- Información del cliente --}}

      @include('content.clientes._partials.conyuge') {{-- Información del conyuge --}}
    </div>
  </form>

  {{-- Off canvas de Ayuda--}}
  {{--<div class="mt-3">--}}
  {{--  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel">--}}
  {{--    <div class="offcanvas-header">--}}
  {{--      <h5 id="offcanvasEndLabel" class="offcanvas-title">Sección de Ayuda</h5>--}}
  {{--      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>--}}
  {{--    </div>--}}

  {{--    <div class="offcanvas-body mx-0 flex-grow-0">--}}
  {{--      <h5>¿Cómo registrar un nuevo cliente?</h5>--}}
  {{--      <iframe src="https://www.youtube.com/embed/xcJtL7QggTI?si=ox0HflKK3Jy9A4qJ"--}}
  {{--              title="YouTube video player" frameborder="0"--}}
  {{--              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"--}}
  {{--              allowfullscreen></iframe>--}}
  {{--    </div>--}}
  {{--  </div>--}}
  {{--</div>--}}

@endsection

@section('page-script')

  <script src="{{ asset('assets/js/cliente.js') }}"></script>

  {{-- Guardar Cliente y todos sus datos --}}
  <script>
    /* Variables y constantes */
    const card_cliente = $('#card-cliente');
    const card_conyuge = $('#card-conyuge');

    const btn_guardar_cliente = $('#btn-guardar-cliente');

    const item_cliente = $('#item-cliente');
    const item_conyuge = $('#item-conyuge');

    const alerta_error = $('#alerta-error');

    const mensaje_error = $('#mensaje-error');

    const form_cliente = $('#form-cliente');
    const form_conyuge = $('#form-conyuge');
    const form_telscliente = $('#form-telscliente');
    const form_telsconyuge = $('#form-telsconyuge');

    const cant_errores_cliente = $('#cant-errores-cliente');
    const cant_errores_conyuge = $('#cant-errores-conyuge');

    const select_estado_civil_cliente = $('#estado_civil_cliente');

    const tabla_telefonos_cliente = $('#tabla-telefonos-cliente');
    const tabla_telefonos_conyuge = $('#tabla-telefonos-conyuge');

    const lista_telefonos_cliente = $('#lista-telefonos-cliente');
    const lista_telefonos_conyuge = $('#lista-telefonos-conyuge');

    const submit_tel_cliente = $('#submit_tel_cliente');
    const submit_tel_conyuge = $('#btn-agregar-telefono-conyuge');

    const mensaje_tel_cliente = $('#mensaje_tel_cliente');
    const mensaje_tel_conyuge = $('#mensaje-tel-conyuge');

    const input_tel_cliente = $('#tel_cliente');
    const input_tel_conyuge = $('#tel_conyuge');

    const telefono_modal_cliente = $('#telefono-modal-cliente');
    const telefono_modal_conyuge = $('#telefono-modal-conyuge');

    $(document).ready(function () {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      /**
       * VALIDACIONES DE FORMULARIO
       * Y EVENTOS DE BOTONES
       * **/

      /* Remover errores */
      let inputs = form_cliente.find('input, select, textarea');

      inputs.change(function () {
        $(this).removeClass('is-invalid'); //Eliminar clase 'is-invalid'
        cant_errores_cliente.html(form_cliente.find('.is-invalid').length);
      });

      inputs.change(function () {
        $(this).removeClass('is-invalid'); //Eliminar clase 'is-invalid'
        cant_errores_conyuge.html(form_cliente.find('.is-invalid').length);
      });

      select_estado_civil_cliente.on('change', function () {
        item_conyuge.addClass('disabled');

        if (this.value === 'Casado') {
          item_conyuge.removeClass('disabled');
        }
      });

      /**
       * FIN VALIDACIONES DE FORMULARIO
       */


      /** EVENTOS DE BOTONES CLIENTE **/
      btn_guardar_cliente.click(function (e) {
        e.preventDefault();

        $.ajax({
          url: '{{ route("clientes.store") }}',
          type: 'post',
          dataType: 'json',
          data: form_cliente.serialize(),
          success: function (data) {
            /* Mensaje de exito */
            if (data.success) {
              window.location.href = '{{ route("clientes.index") }}' + '?success=true';
            } else {
              cant_errores_cliente.addClass('d-none');
              cant_errores_conyuge.addClass('d-none');

              switch (data.tab) {
                case 'cliente':
                  cambiarTab('cliente');
                  cant_errores_cliente.html(1).removeClass('d-none');
                  tabla_telefonos_cliente.addClass('border border-danger');
                  break;

                case 'conyuge':
                  cambiarTab('conyuge');
                  cant_errores_conyuge.html(1).removeClass('d-none');
                  tabla_telefonos_conyuge.addClass('border border-danger');
                  break;
              }

              alerta_error.removeClass('d-none').addClass('d-flex');
              menubar.html(data.message);
            }
          },
          error: function (xhr) {
            let data = xhr.toJSON();
            if ($.isEmptyObject(data.errors) === false) {
              let i = 0;
              let isCliente = false;
              let isConyuge = false;
              $.each(data.errors, function (key, value) {
                // Mostrar errores en los inputs
                $('#' + key).addClass('is-invalid');
                $('#' + key + '_error').html(value); // Agregar el mensaje de error

                if (key.includes('cliente')) {
                  isCliente = true;
                }

                if (key.includes('conyuge')) {
                  isConyuge = true;
                }

                i++;
              });

              if (isCliente) {
                cambiarTab('cliente');
                alerta_error.removeClass('d-none').addClass('d-flex');
                mensaje_error.html('Por favor, complete los campos marcados en rojo.');
                cant_errores_cliente.html(i).removeClass('d-none');
              } else if (isConyuge) {
                cambiarTab('conyuge');
                cant_errores_cliente.addClass('d-none');
                alerta_error.removeClass('d-none').addClass('d-flex');
                mensaje_error.html('Por favor, complete los campos marcados en rojo.');
                cant_errores_conyuge.html(i).removeClass('d-none');
              }

            }
          }
        });
      });
      /** FIN EVENTOS DE BOTONES CLIENTE **/


      /** EVENTOS DE BOTONES TELEFONO CLIENTE **/
      submit_tel_cliente.click(function (e) {
        e.preventDefault();

        let mensaje = '';

        if (input_tel_cliente.val() === '') {
          mensaje = 'El campo es obligatorio.';
          input_tel_cliente.addClass('is-invalid');
        } else if (input_tel_cliente.val().length < 8) {
          mensaje = 'El campo debe tener al menos 8 caracteres.';
          input_tel_cliente.addClass('is-invalid');
        } else {
          let datos = 'tel_cliente=' + input_tel_cliente.val();
          datos += '&opcion=agregar&session=true';

          $.ajax({
            url: '{{ route("telsCliente.store") }}',
            type: 'post',
            dataType: 'json',
            data: datos,
            success: function (data) {
              /* Mensaje de exito */
              if(data.success === false){
                input_tel_cliente.addClass('is-invalid');
                mensaje_tel_cliente.html(data.message);
              }else{
                telefono_modal_cliente.modal('hide');
                input_tel_cliente.val('');
                mostrarTelefonosCliente(data);
              }
            },
            error: function (xhr) {
              /* Mensajes de error */
            }
          });
        }

        mensaje_tel_cliente.html(mensaje);
      });
      /** FIN EVENTOS DE BOTONES TELEFONO CLIENTE **/

      /** EVENTOS DE BOTONES TELEFONO CONYUGE **/
      submit_tel_conyuge.click(function (e) {
        e.preventDefault();

        if (input_tel_conyuge.val() === '') {
          input_tel_conyuge.addClass('is-invalid');
          mensaje_tel_conyuge.html('El campo es obligatorio.');
        } else if (input_tel_conyuge.val().length < 8) {
          input_tel_conyuge.addClass('is-invalid');
          mensaje_tel_conyuge.html('El campo debe tener al menos 8 caracteres.');
        } else {
          let datos = '&opcion=agregar&session=true';
          datos += '&tel_conyuge=' + input_tel_conyuge.val();

          $.ajax({
            url: '{{ route("telsConyuge.store") }}',
            type: 'post',
            dataType: 'json',
            data: datos,
            success: function (data) {

              /* Mensaje de exito */
              if(data.success === false){
                input_tel_conyuge.addClass('is-invalid');
                mensaje_tel_conyuge.html(data.message);
              }else{
                telefono_modal_conyuge.modal('hide');
                input_tel_conyuge.val('');
                mostrarTelefonosConyuge(data);
              }
            },
            error: function (xhr) {
              /* Mensajes de error */
            }
          });
        }
      });
      /** FIN EVENTOS DE BOTONES TELEFONO CONYUGE **/

    });

    function cambiarTab(tab) {
      card_cliente.removeClass('active show');
      card_conyuge.removeClass('active show');

      item_cliente.removeClass('active');
      item_conyuge.removeClass('active');

      $('#item-' + tab).attr('aria-selected', 'true').addClass('active');
      $('#card-' + tab).addClass('active show');
    }


    /** FUNCIONES DE TELEFONO CLIENTE **/
    function eliminarTelefonoCliente(id) {
      let datos = form_telscliente.serialize();
      datos += '&opcion=eliminar';
      datos += '&id=' + id;
      datos += '&session=true';

      $.ajax({
        url: '{{ route("telsCliente.store") }}',
        type: 'post',
        dataType: 'json',
        data: datos,
        success: function (data) {
          /* Mensaje de exito */
          telefono_modal_cliente.modal('hide');
          form_telscliente.trigger('reset');
          mostrarTelefonosCliente(data);
        },
        error: function (xhr) {
          /* Mensajes de error */
        }
      });
    }

    function mostrarTelefonosCliente(data) {
      let html = "";
      let i = 1;
      $.each(data, function (key, value) {
        html += '<tr id="ref_' + key + '">';
        html += '<td>' + i + '</td>';
        html += '<td>+503 ' + value['tel_cliente'] + '</td>';
        html += "<td>" +
          "<button type='button' class='btn btn-outline-danger btn-sm' onclick='eliminarTelefonoCliente(" + key + ")'>" +
          "<i class='tf-icons bx bx-trash'></i>" +
          "</button>" +
          "</td>";
        html += '</tr>';

        i++;
      });

      if (data.length === 0) {
        html += '<tr><td colspan="3">No hay resultados</td></tr>';
      }

      tabla_telefonos_cliente.removeClass('border border-danger');
      lista_telefonos_cliente.html(html);
    }

    /** FIN FUNCIONES DE TELEFONO CLIENTE **/

    /** FUNCIONES DE TELEFONO CONYUGE **/
    function eliminarTelefonoConyuge(id) {
      let datos = form_telsconyuge.serialize();
      datos += '&opcion=eliminar';
      datos += '&id=' + id;
      datos += '&session=true';

      $.ajax({
        url: '{{ route("telsConyuge.store") }}',
        type: 'post',
        dataType: 'json',
        data: datos,
        success: function (data) {
          /* Mensaje de exito */
          telefono_modal_cliente.modal('hide');
          form_telsconyuge.trigger('reset');
          mostrarTelefonosConyuge(data);
        },
        error: function (xhr) {
          /* Mensajes de error */
        }
      });
    }

    function mostrarTelefonosConyuge(data) {
      let html = "";
      let i = 1;

      console.log(data);

      $.each(data, function (key, value) {
        html += '<tr id="ref_' + key + '">';
        html += '<td>' + i + '</td>';
        html += '<td>+503 ' + value['tel_conyuge'] + '</td>';
        html += "<td>" +
          "<button type='button' class='btn btn-outline-danger btn-sm' onclick='eliminarTelefonoConyuge(" + key + ")'>" +
          "<i class='tf-icons bx bx-trash'></i>" +
          "</button>" +
          "</td>";
        html += '</tr>';

        i++;
      });

      if (data.length === 0) {
        html += '<tr><td colspan="3">No hay resultados</td></tr>';
      }

      tabla_telefonos_conyuge.removeClass('border border-danger');
      cant_errores_conyuge.addClass('d-none');
      alerta_error.removeClass('d-flex').addClass('d-none');
      lista_telefonos_conyuge.html(html);
    }

    /** FIN FUNCIONES DE TELEFONO CONYUGE **/

  </script>
@endsection
