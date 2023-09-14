@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Nuevo Cliente')
@section('content')
  {{--  <form action="{{ route('clientes.store') }}" method="post" autocomplete="off" enctype="multipart/form-data" id="form-cliente">--}}
  {{--    @csrf --}}{{-- Security --}}

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

            <button class="nav-link btn btn-primary" type="button" id="btn-guardar-cliente">
              <span class="tf-icons bx bx-save"></span>
              Guardar
            </button>
          </li>
          <li class="list-inline-item fw-semibold">
            <a class="nav-link btn btn-secondary" type="button" href="{{ route('clientes.index') }}"> Cancelar</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  {{-- Navegación de Formulario --}}
  <ul class="nav nav-pills nav-align-left nav-card-header-pills align-items-center" role="tablist">
    <li class="nav-item" role="presentation">
      <button type="button" class="btn step active" role="tab" data-bs-toggle="tab"
              data-bs-target="#card-datos-cliente" aria-controls="card-datos-cliente" aria-selected="true">
        <span class="badge bg-label-secondary"><i class="bx bx-user"></i></span>
        <span class="bs-stepper-title">Información</span>
      </button>
    </li>
    <li>
      <div class="line d-none d-md-inline-block align-items-baseline">
        <i class="bx bx-chevron-right"></i>
      </div>
    </li>
    <li class="nav-item" role="presentation">
      <button type="button" class="btn step" role="tab" data-bs-toggle="tab" data-bs-target="#card-conyuge"
              aria-controls="card-conyuge" aria-selected="false" tabindex="-1">
        <span class="badge bg-label-secondary"><i class="bx bx-user-check"></i></span>

        <span class="bs-stepper-label mt-1">
        <span class="bs-stepper-title">Conyuge</span>
      </span>
      </button>
    </li>
    <li>
      <div class="line d-none d-md-inline-block align-items-baseline">
        <i class="bx bx-chevron-right"></i>
      </div>
    </li>
    <li class="nav-item" role="presentation">
      <button type="button" class="btn step" role="tab" data-bs-toggle="tab" data-bs-target="#card-datos-negocios"
              aria-controls="card-datos-negocios" aria-selected="false" tabindex="-1">
        <span class="badge bg-label-secondary"><i class="bx bx-store-alt"></i></span>

        <span class="bs-stepper-label mt-1">
        <span class="bs-stepper-title">Negocio</span>
      </span>
      </button>
    </li>
    <li>
      <div class="line d-none d-md-inline-block align-items-baseline">
        <i class="bx bx-chevron-right"></i>
      </div>
    </li>

    <li class="nav-item" role="presentation">
      <button type="button" class="btn step" role="tab" data-bs-toggle="tab" data-bs-target="#card-referencia"
              aria-controls="card-referencia" aria-selected="false" tabindex="-1">
        <span class="badge bg-label-secondary"><i class="bx bx-user-plus"></i></span>

        <span class="bs-stepper-label mt-1">
        <span class="bs-stepper-title">Referencias</span>
    </span>
      </button>
    </li>
    <li>
      <div class="line d-none d-md-inline-block align-items-baseline">
        <i class="bx bx-chevron-right"></i>
      </div>
    </li>
    <li class="nav-item" role="presentation">
      <button type="button" class="btn step" role="tab" data-bs-toggle="tab" data-bs-target="#card-bienes"
              aria-controls="card-bienes" aria-selected="false" tabindex="-1">
        <span class="badge bg-label-secondary"><i class="bx bx-buildings"></i></span>

        <span class="bs-stepper-label mt-1">
        <span class="bs-stepper-title">Bienes</span>
      </span>
      </button>
    </li>
  </ul>


  <!-- Datos del Cliente -->
  <div class="tab-content p-0">
    @include('content.clientes._partials.info') {{-- Información del cliente --}}

    @include('content.clientes._partials.conyuge') {{-- Información del conyuge --}}

    @include('content.clientes._partials.negocios') {{-- Información de los negocios --}}

    @include('content.clientes._partials.referencias') {{-- Información de las referencias --}}

    @include('content.clientes._partials.bienes') {{-- Información de los bienes --}}
  </div>
  {{--  </form>--}}

  @include('content.clientes._partials.modals') {{-- Modal para agregar teléfonos --}}



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
    $(document).ready(function () {

      $('#btn-guardar-cliente').click(function (e) {

        e.preventDefault();

        $.ajax({
          url: '{{ route("clientes.store") }}',
          type: 'post',
          dataType: 'json',
          data: $('#form-cliente').serialize(),
          success: function (data) {
            /* Mensaje de exito */

          },
          error: function (xhr) {

            /* Remover errores */
            var inputs = $('#form-cliente').find('input, select, textarea');

            inputs.change(function () {
              $(this).removeClass('is-invalid'); //Eliminar clase 'is-invalid'
            });

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

      $('#btn-agregar-negocio').click(function (e) {
        e.preventDefault();

        $.ajax({
          url: '{{ route("negocios.store") }}',
          type: 'post',
          dataType: 'json',
          data: $('#form-negocio').serialize(),
          success: function (data) {

            var html = "";

            $.each(data, function (key, value) {
              html += '<tr id="negocio_' + key + '">';
              html += '<td>' + key + '</td>';
              html += '<td>' + value.nom_negocio + '</td>';
              html += '<td>' + value.dir_negocio + '</td>';
              html += '<td>' + value.tiempo_negocio + '</td>';
              html += '<td>';
              html += '<button type="button" class="btn btn-icon btn-warning" data-bs-toggle="modal" data-bs-target="#negocio-modal-editar" data-id="' + value.id + '" data-nom_negocio="' + value.nom_negocio + '" data-dir_negocio="' + value.dir_negocio + '" data-tiempo_negocio="' + value.tiempo_negocio + '"><span class="tf-icons bx bx-edit-alt"></span></button>';
              html += '<button type="button" class="btn btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#negocio-modal-eliminar" data-id="' + value.id + '"><span class="tf-icons bx bx-trash"></span></button>';
              html += '</td>';
            });

            $('#tabla-negocios').html(html);
          },
          error: function (xhr) {

          }
        });

      })
    });
  </script>
@endsection
