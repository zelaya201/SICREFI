@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Nuevo Usuario')

@section('page-style')

@endsection

@section('content')
  <form action="{{ route('usuarios.store') }}" method="post" autocomplete="off" enctype="multipart/form-data"
        id="form-usuario">
    @csrf

    <div class="d-flex align-items-center justify-content-between py-3">
      <div class="flex-grow-1">
        <div
          class="d-flex align-items-center justify-content-md-between justify-content-start flex-md-row flex-column gap-4">
          <div class="user-profile-info">
            <h4 class="fw-bold m-0"><span class="text-muted fw-light">Usuarios /</span> Nuevo Usuario</h4>
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

              <button class="nav-link btn btn-primary load" type="button" id="btn_confirmar">
                <span class="tf-icons bx bx-save"></span>
                Guardar usuario
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

    @include('content.usuarios.form')

  </form>

@endsection

@section('page-script')
  <script src="{{ asset('assets/js/selectr.min.js') }}"></script>

  <script>
    const btn_guardar_usuario = $('#btn_guardar_usuario');
    const btn_confirmar = $('#btn_confirmar');

    const form_usuario = $('#form-usuario');
    const inputs = form_usuario.find('input, select, textarea, checkbox');


    const modal = $('#modal');
    const modal_title = $('#modal_title');
    const modal_body = $('#modal_body');

    inputs.change(function () {
      $(this).removeClass('is-invalid'); //Eliminar clase 'is-invalid'
    });

    btn_confirmar.on('click', function () {

      // Validar campos
      if(inputs.toArray().some(input => $(input).val() === '')){
        btn_guardar_usuario.click();
        return;
      }

      modal_title.html(`<i class="bx bx-info-circle bx-lg text-primary"></i> <b>Confirmar acción</b>`);
      modal_body.html(`
            <p>
                ¿Estás seguro que deseas guardar el usuario con los siguientes datos?
                <ul class="text-start">
                    <li>Nombre: <b>${$('#nom_usuario').val()} ${$('#ape_usuario').val()}</b></li>
                    <li>Usuario: <b>${$('#nick_usuario').val()}</b></li>
                    <li>Rol: <b>${$('#id_rol option:selected').text()}</b></li>
                    <li>Correo electrónico: <b>${$('#email_usuario').val()}</b></li>
                </ul>

                <span><b>Nota:</b> Las credenciales se enviarán al correo electrónico proporcionado.</span>
            </p>
      `);
      btn_guardar_usuario.text('Si, guardar');
      btn_guardar_usuario.attr('class', 'btn btn-primary');

      modal.modal('show');
    });

    /* ############################################ */
    btn_guardar_usuario.on('click', function () {
      // REGISTRAR USUARIO

      $.ajax({
        url: '{{ route("usuarios.store") }}',
        type: 'post',
        dataType: 'json',
        data: form_usuario.serialize(),
        success: function (data) {
          if (data.success) {
            window.location.href = '{{ route("usuarios.index") }}';
          }
        },
        error: function (xhr) {
          var data = xhr.responseJSON;

          if ($.isEmptyObject(data.errors) === false) {
            $.each(data.errors, function (key, value) {
              // Mostrar errores en los inputs
              $('#' + key).addClass('is-invalid');
              $('#' + key + '_error').html(value); // Agregar el mensaje de error
              $('#' + key + '_label').addClass('border border-danger rounded')
            });
          }

          modal.modal('hide');
        }
      });
    });
    /* ############################################ */
  </script>

@endsection
