@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Nuevo Crédito')

@section('page-style')


  <link href="https://cdn.jsdelivr.net/gh/mobius1/selectr@latest/dist/selectr.min.css" rel="stylesheet" type="text/css">
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

              <button class="nav-link btn btn-primary" type="button" id="btn-guardar-credito">
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
    new Selectr('#id_cliente', {
      searchable: true,
      placeholder: 'Seleccione un cliente',
      defaultSelected: '{{ old('id_cliente') }}',

      messages: {
        noResults: "No se encontraron resultados."
      }

    });

    new Selectr('#id_credito', {
      searchable: true,
      placeholder: 'Seleccione un tipo de crédito',
      defaultSelected: '{{ old('id_credito') }}',

      messages: {
        noResults: "No se encontraron resultados.",
        noOptions: "No hay créditos disponibles."
      }

    });

    new Selectr('#id_bien', {
      searchable: true,
      placeholder: 'Seleccione los bienes',
      defaultSelected: '{{ old('id_bien') }}',
      messages: {
        noResults: "No se encontraron resultados.",
        noOptions: "No hay bienes disponibles."
      },
    });

  </script>

@endsection
