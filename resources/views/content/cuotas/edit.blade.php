@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Cuotas')
@section('content')
  <div class=" flex-grow-1 py-3">
    <div
      class="d-flex align-items-center justify-content-md-between justify-content-start flex-md-row flex-column mb-1">
      <div class="user-profile-info py-1">
        <h4 class="fw-bold m-0"><span class="text-muted fw-light">Créditos /</span> Pago de cuotas</h4>
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
          <a class="nav-link btn btn-secondary load" type="button" href="{{ route('creditos.index') }}"><i
              class="bx bx-arrow-back me-1"></i>Atrás
          </a>
        </li>
      </ul>
    </div>

    <div class="mb-2">
      <h4 class="mb-1">
        ID Cliente #
      </h4>
      <p class="mb-0">
        Registrado:
      </p>
    </div>

    <div class="card mb-4">
      <div class="card-header pb-0">
        <span class="fw-bold">Datos generales</span>
        <hr class="my-2">
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4 mb-3">
            <span class="fw-bold">DUI:</span>
            <span>{{ $cliente->dui_cliente }}</span>
          </div>

          <div class="col-md-4 mb-3">
            <span class="fw-bold">Nombre:</span>
            <span>{{ $cliente->nombre_completo }}</span>
          </div>

          <div class="col-md-4">
            <span class="fw-bold">Dirección:</span>
            <span>{{ $cliente->dir_cliente }}</span>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <span class="fw-bold">Teléfono:</span>
            <span>+503 </span>
          </div>

          <div class="col-md-4">
            <span class="fw-bold">Estado:</span>
            <span>
              @if($cliente->estado_cliente == 'Activo')
                <span class="badge rounded-pill bg-label-success">{{ $cliente->estado_cliente }}</span>
              @else
                <span class="badge rounded-pill bg-label-danger">{{ $cliente->estado_cliente }}</span>
              @endif
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
