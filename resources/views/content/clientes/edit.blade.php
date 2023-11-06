@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Editar Cliente')
@section('content')
  <form action="{{ route('clientes.edit', $cliente->id_cliente) }}" method="get" autocomplete="off" enctype="multipart/form-data"
        id="form-cliente">

    <div class="d-flex align-items-center justify-content-between py-3">
      <div class="flex-grow-1">
        <div
          class="d-flex align-items-center justify-content-md-between justify-content-start flex-md-row flex-column gap-4">
          <div class="user-profile-info">
            <h4 class="fw-bold m-0"><span class="text-muted fw-light">Clientes / </span>
              {{ $cliente->dui_cliente }} - {{ $cliente->primer_nom_cliente . ' ' . $cliente->primer_ape_cliente }}
            </h4>
          </div>
          <ul
            class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
            <li class="list-inline-item fw-semibold">
              <button type="submit" class="btn rounded-pill btn-icon btn-warning"
                      data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd" aria-controls="offcanvasEnd"
                      data-bs-offset="0,4"
                      data-bs-placement="top" data-bs-html="true" title="Ayuda">
                <span class="tf-icons bx bx-question-mark"></span>
              </button>
            </li>
            <li class="list-inline-item fw-semibold">

              <button class="nav-link btn btn-primary" type="button" id="btn-modificar-cliente">
                <span class="tf-icons bx bx-edit-alt me-1"></span> Modificar
              </button>
            </li>
            <li class="list-inline-item fw-semibold">
              <a class="nav-link btn btn-secondary" type="button" href="{{ route('clientes.index') }}"> Cancelar
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    {{-- Navegación de Formulario --}}
    {{--  <ul class="nav nav-pills nav-align-left nav-card-header-pills align-items-center" role="tablist">--}}
    <ul class="nav nav-pills" role="tablist">
      <li class="nav-item" role="presentation">
        <a class="nav-link active" type="button" aria-selected="false" tabindex="-1"
           href="{{ route('clientes.showEdit', $cliente->id_cliente) }}">
          <i class="bx bx-user"></i> Cliente
        </a>
      </li>

      <li class="nav-item" role="presentation">
        <a class="nav-link {{ ($cliente->estado_civil_cliente != 'Casado') ? 'disabled' : '' }}" type="button"
           aria-selected="false" tabindex="-1"
           href="{{ route('conyuge.edit', $cliente->id_cliente) }}">
          <i class="bx bx-user-check"></i> Conyuge
        </a>
      </li>

      <li class="nav-item" role="presentation">
        <a class="nav-link" type="button" aria-selected="false" tabindex="-1"
           href="{{ route('negocios.show', $cliente->id_cliente) }}">
          <i class="tf-icons bx bx-store-alt"></i> Negocio
        </a>
      </li>

      <li class="nav-item" role="presentation">
        <a class="nav-link" type="button" aria-selected="false" tabindex="-1" data-bs-target="#card-referencia"
           href="{{ route('referencias.show', $cliente->id_cliente) }}">
          <i class="bx bx-user-plus"></i> Referencias
        </a>
      </li>

      <li class="nav-item" role="presentation">
        <a class="nav-link" type="button" aria-selected="false" tabindex="-1"
           href="{{ route('bienes.show', $cliente->id_cliente) }}">
          <i class="bx bx-building"></i> Bienes
        </a>
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
      @include('content.clientes._partials-edit.info-edit') {{-- Información del cliente --}}


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

    /* Función para validar el monto */
    $(document).ready(function () {

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('#btn-modificar-cliente').on('click', function (){
        $.ajax({
          url : '{{ route("clientes.store") }}',
          type : 'POST',
          dataType : 'json',
          data : $('#form-cliente').serialize() + '&modificarCliente=true&id_cliente=' + {{ $cliente->id_cliente }},
          success : function (data) {
            if (data.success) {
              window.location.href = '{{ route('clientes.index') }}';
            }
          },
          error : function (xhr){
            var data = xhr.responseJSON;
            if ($.isEmptyObject(data.errors) === false) {
              $.each(data.errors, function (key, value) {
                // Mostrar errores en los inputs
                $('#' + key).addClass('is-invalid');
                $('#' + key + '_error').html(value); // Agregar el mensaje de error
              });
            }
          }
        });
      });

      /* ALMACENAR TELEFONO */
      $('#submit_tel_cliente').on('click', function (){
        let id = $('#id_cliente').val();
        let tel = $('#tel_cliente').val();

        $.ajax({
          url: '{{ route("telsCliente.edit", ":id_cliente") }}'.replace(':id_cliente', id),
          type: 'get',
          data: {
            id : id,
            tel: tel,
          },
          success: function(data) {
            if(data.success) {
              // Reedireccionar a la página de clientes
              location.reload();
            }
          }
        });
      });

      /* ELIMINAR TELEFONO */
      $('#eliminar_telefono').on('click', function (){
        let id = $('#id_tel').val();

        $.ajax({
          url: '{{ route("telsCliente.destroy", ":id_tel") }}'.replace(':id_tel', id),
          type: 'delete',
          data: {
            id : id,
          },
          success: function(data) {
            if(data.success) {
              // Reedireccionar a la página de clientes
              location.reload()
            }
          }
        });
      });

      /** FIN EVENTOS DE BOTONES CLIENTE **/


      /** EVENTOS DE BOTONES TELEFONO CLIENTE **/
      $('#btn-agregar-telefono-cliente').click(function (e) {
        e.preventDefault();

        var objtel_cliente = $('#tel_cliente');

        if (objtel_cliente.val() === '') {
          objtel_cliente.addClass('is-invalid');
          $('#mensaje_tel_cliente').html('El campo es obligatorio.');
        } else if (objtel_cliente.val().length < 8) {
          objtel_cliente.addClass('is-invalid');
          $('#mensaje_tel_cliente').html('El campo debe tener al menos 8 caracteres.');
        } else {
          let datos = 'tel_cliente=' + objtel_cliente.val();
          datos += '&opcion=agregar';
          datos += '&session=true';

          $.ajax({
            url: '{{ route("telsCliente.store") }}',
            type: 'post',
            dataType: 'json',
            data: datos,
            success: function (data) {
              /* Mensaje de exito */
              if (data.success === false) {
                objtel_cliente.addClass('is-invalid');
                $('#mensaje_tel_cliente').html(data.message);

                objtel_cliente.change(function () {
                  $(this).removeClass('is-invalid'); //Eliminar clase 'is-invalid'
                });
              } else {
                $('#telefono-modal-cliente').modal('hide');
                $('#tel_cliente').val('');
                mostrarTelefonosCliente(data);
              }

            },
            error: function (xhr) {
              /* Mensajes de error */
            }
          });
        }
      });
      /** FIN EVENTOS DE BOTONES TELEFONO CLIENTE **/
    });


  </script>
@endsection
