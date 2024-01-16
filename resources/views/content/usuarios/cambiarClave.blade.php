@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Nuevo Usuario')

@section('page-style')

@endsection

@section('content')

  <div class="pt-3">
    <h4 class="mb-1">
      ID Usuario: {{ $usuario->id_usuario }}
    </h4>
    <p class="mb-0">
      Nombre: {{ $usuario->nom_usuario . ' ' . $usuario->ape_usuario }}
    </p>
  </div>


  <form action="{{ route('usuarios.update', $usuario->id_usuario) }}" method="post" autocomplete="off" enctype="multipart/form-data"
        id="form-clave">
    @csrf

    <div class="d-flex align-items-center justify-content-between pb-3">
      <div class="flex-grow-1">
        <div
          class="d-flex align-items-center justify-content-md-between justify-content-start flex-md-row flex-column gap-4">
          <div class="user-profile-info">
            <h4 class="fw-bold m-0"><span class="text-muted fw-light">Usuarios /</span> Cambiar Contraseña</h4>
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

              <button class="nav-link btn btn-primary load" type="button" id="btn_cambiar_credencial" disabled>
                <span class="tf-icons bx bx-lock-alt"></span>
                Cambiar contraseña
              </button>
            </li>
            <li class="list-inline-item fw-semibold">
              <a class="nav-link btn btn-secondary load" type="button" href="{{ route('usuarios.index') }}"> Cancelar
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12 mb-4">
        <div class="card h-100">
          <div class="card-header pb-0">
            <span class="fw-bold">Cambio de contraseña</span>
            <hr class="my-2">
          </div>
          <div class="card-body">

            <div class="row">
              <div class="col-md-4 mb-3">
                <label class="form-label" for="clave_usuario">Contraseña anterior (*)</label>
                <input type="text" class="form-control" placeholder="**************" name="clave_usuario" id="clave_usuario" value="">
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                  <div data-field="name" data-validator="notEmpty" id="clave_usuario_error"></div>
                </div>
              </div>

              <div class="col-md-4 mb-3">
                <label class="form-label" for="clave_nueva">Contraseña nueva (*)</label>
                <input type="text" class="form-control"  placeholder="**************" name="clave_nueva" id="clave_nueva" value="">
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                  <div data-field="name" data-validator="notEmpty" id="clave_nueva_error"></div>
                </div>
              </div>

              <div class="col-md-4 mb-3">
                <label class="form-label" for="repetir_clave">Repetir contraseña (*)</label>
                <input type="text" class="form-control" placeholder="**************" name="repetir_clave" id="repetir_clave" value="">
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                  <div data-field="name" data-validator="notEmpty" id="repetir_clave_error"></div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 mb-3 text-end">
                Los campos marcados con <span class="text-danger">(*)</span> son obligatorios
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>


  </form>

@endsection

@section('page-script')
  <script src="{{ asset('assets/js/selectr.min.js') }}"></script>

  <script>
    const btn_cambiar_credencial = $('#btn_cambiar_credencial');
    const form_clave = $('#form-clave');

    const inputs = form_clave.find('input, select, textarea, checkbox');

    const clave_anterior = $('#clave_usuario');
    const clave_nueva = $('#clave_nueva');
    const repetir_clave = $('#repetir_clave');

    const clave_anterior_error = $('#clave_usuario_error');
    const clave_nueva_error = $('#clave_nueva_error');
    const repetir_clave_error = $('#repetir_clave_error');

    clave_nueva.on('keyup', function () {
        verificarClave();
    });

    repetir_clave.on('keyup', function () {
        verificarClave();
    });

    function verificarClave(){
      if (clave_nueva.val() !== repetir_clave.val() || clave_nueva.val() === '' || repetir_clave.val() === '') {
        repetir_clave.addClass('is-invalid');
        repetir_clave_error.html('Las contraseñas no coinciden');

        btn_cambiar_credencial.prop('disabled', true);
      } else {
        if(clave_nueva.val().length < 8){
          repetir_clave.addClass('is-invalid');
          repetir_clave_error.html('La contraseña debe tener al menos 8 caracteres');

          btn_cambiar_credencial.prop('disabled', true);
        }else{
            repetir_clave.removeClass('is-invalid');
            repetir_clave_error.html('');

            btn_cambiar_credencial.prop('disabled', false);
        }
      }
    }

    $(document).ready(function () {

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
      });

      /* ############################################ */
      btn_cambiar_credencial.on('click', function () {
        // MODIFICAR USUARIO

        $.ajax({
          url: '{{ route("usuarios.cambiarClave", ':id') }}'.replace(':id', {{ $usuario->id_usuario }}),
          type: 'GET',
          dataType: 'json',
          data: form_clave.serialize() + '&id_usuario=' + {{ $usuario->id_usuario }},
          progress: function () {

          },
          success: function (data) {
            if (data.success) {
              window.location.href = '{{ route('usuarios.index') }}';
            }else{
              // Mostrar errores en los inputs
                $('#clave_usuario').addClass('is-invalid');
                $('#clave_usuario_error').html(data.message); // Agregar el mensaje de error
            }
          },
          error: function (xhr) {
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

    });
    /* ############################################ */
  </script>

@endsection
