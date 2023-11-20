@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Editar Cliente')
@section('content')
  <form action="{{ route('clientes.edit', $cliente->id_cliente) }}" method="get" autocomplete="off"
        enctype="multipart/form-data"
        id="form-cliente">

    <div class="d-flex align-items-center justify-content-between py-3">
      <div class="flex-grow-1">
        <div
          class="d-flex align-items-center justify-content-md-between justify-content-start flex-md-row flex-column gap-4">
          <div class="user-profile-info">
            <h4 class="fw-bold m-0"><span class="text-muted fw-light">Clientes / </span>
              Editar cliente
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

    @include('content.clientes._partials.nav')

    @if(Session::has('success'))
      <div class="alert alert-primary d-flex m-0 mt-3" role="alert">
          <span class="badge badge-center rounded-pill bg-primary border-label-primary p-3 me-2"><i
              class="bx bx-user fs-6"></i></span>
        <div class="d-flex flex-column ps-1">
          <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Mensaje de éxito</h6>
          <span>{{ Session::get('message') }}</span>
        </div>
      </div>
    @endif

    <div class="tab-content p-0">
      @include('content.clientes._partials.form') {{-- Información del cliente --}}


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

      $('#btn-modificar-cliente').on('click', function () {
        $('#btn-modificar-cliente').prop('disabled', true);
        $('#btn-modificar-cliente').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Modificando...');

        $.ajax({
          url: '{{ route("clientes.update", ':id') }}'.replace(':id', {{ $cliente->id_cliente }}),
          type: 'PUT',
          dataType: 'json',
          data: $('#form-cliente').serialize() + '&modificarCliente=true&id_cliente=' + {{ $cliente->id_cliente }},
          progress: function () {
            $('#btn-modificar-cliente').prop('disabled', true);
          },
          success: function (data) {
            if (data.success) {
              window.location.href = '{{ route('clientes.index') }}';
            }
          },
          error: function (xhr) {
            var data = xhr.responseJSON;
            if ($.isEmptyObject(data.errors) === false) {
              $.each(data.errors, function (key, value) {
                // Mostrar errores en los inputs
                $('#' + key).addClass('is-invalid');
                $('#' + key + '_error').html(value); // Agregar el mensaje de error

                $('#btn-modificar-cliente').prop('disabled', false);
                $('#btn-modificar-cliente').html('<span class="tf-icon bx bx-edit-alt me-1"></span> Modificar');
              });
            }
          }
        });
      });

      /** EVENTOS DE BOTONES TELEFONO CLIENTE **/
      $('#submit_tel_cliente').click(function (e) {
        e.preventDefault();
        $(e.target).prop('disabled', true);

        let id = $('#id_cliente').val();
        var objtel_cliente = $('#tel_cliente');

        if (objtel_cliente.val() === '') {
          objtel_cliente.addClass('is-invalid');
          $('#mensaje_tel_cliente').html('El campo es obligatorio.');
          $(e.target).prop('disabled', false);

        } else if (objtel_cliente.val().length < 8) {
          objtel_cliente.addClass('is-invalid');
          $('#mensaje_tel_cliente').html('El campo debe tener al menos 8 caracteres.');
          $(e.target).prop('disabled', false);
        } else {

          $.ajax({
            url: '{{ route("telsCliente.edit", ":id_cliente") }}'.replace(':id_cliente', id),
            type: 'get',
            dataType: 'json',
            data: {
              id: id,
              tel: objtel_cliente.val(),
            },
            success: function (data) {
              /* Mensaje de exito */
              if (data.success) {
                // Reedireccionar a la página de clientes
                location.reload();
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

    /* Función para mostrar los teléfonos del cliente */
    function eliminarTelefono(id, event) {
      // Deshabilitar btn de eliminar que hizo la petición
      $(event.target).prop('disabled', true);

      $.ajax({
        url: "{{ route('telsCliente.destroy', ':id') }}".replace(':id', id),
        type: 'DELETE',
        data: {
          id: id,
          _token: "{{ csrf_token() }}",
        },
        success: function (data) {
          if (data.success) {
            // Reedireccionar a la página de clientes
            location.reload();
          }
        }
      });
    }

  </script>
@endsection
