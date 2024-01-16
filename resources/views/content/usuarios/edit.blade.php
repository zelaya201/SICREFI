@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Nuevo Usuario')

@section('page-style')

@endsection

@section('content')
  <form action="{{ route('usuarios.update', $usuario->id_usuario) }}" method="post" autocomplete="off" enctype="multipart/form-data"
        id="form-usuario">
    @csrf

    <div class="d-flex align-items-center justify-content-between py-3">
      <div class="flex-grow-1">
        <div
          class="d-flex align-items-center justify-content-md-between justify-content-start flex-md-row flex-column gap-4">
          <div class="user-profile-info">
            <h4 class="fw-bold m-0"><span class="text-muted fw-light">Usuarios /</span> Editar Usuario</h4>
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

              <button class="nav-link btn btn-primary load" type="button" id="btn_editar_usuario">
                <span class="tf-icons bx bx-edit-alt"></span>
                Modificar
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
    const btn_editar_usuario = $('#btn_editar_usuario');
    const form_usuario = $('#form-usuario');

    const inputs = form_usuario.find('input, select, textarea, checkbox');

    $(document).ready(function () {

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
      });

      inputs.change(function () {
        $(this).removeClass('is-invalid'); //Eliminar clase 'is-invalid'
      });

      /* ############################################ */
      btn_editar_usuario.on('click', function () {
        // MODIFICAR USUARIO

        $.ajax({
          url: '{{ route("usuarios.update", ':id') }}'.replace(':id', {{ $usuario->id_usuario }}),
          type: 'PUT',
          dataType: 'json',
          data: form_usuario.serialize() + '&id_usuario=' + {{ $usuario->id_usuario }},
          progress: function () {
            $('#btn-modificar-cliente').prop('disabled', true);
          },
          success: function (data) {
            if (data.success) {
              window.location.href = '{{ route('usuarios.index') }}';
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
