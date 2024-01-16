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
        id="form-rol">
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

              <button class="nav-link btn btn-primary load" type="button" id="btn_guardar_rol">
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

    <div class="alert alert-danger d-none m-0 mt-3" role="alert" id="alerta-error">
      <span class="badge badge-center rounded-pill bg-danger border-label-danger p-3 me-2" id="label-error"><i
          class="bx bx-error fs-6"></i></span>
      <div class="d-flex flex-column">
        <h6 class="alert-heading d-flex align-items-center mb-1">Mensaje de alerta</h6>
        <span id="mensaje_error"></span>
      </div>
    </div>

    @include('content.usuarios.form')

  </form>

@endsection

@section('page-script')
  <script src="{{ asset('assets/js/selectr.min.js') }}"></script>

  <script>

  </script>

@endsection
