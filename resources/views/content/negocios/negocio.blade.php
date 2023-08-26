@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Negocio')
@section('content')
  <div class="d-flex align-items-center justify-content-between py-3">
    <div class="flex-grow-1">
      <div
        class="d-flex align-items-center justify-content-md-between justify-content-start flex-md-row flex-column gap-4">
        <div class="user-profile-info">
          <h4 class="fw-bold m-0"><span class="text-muted fw-light">Negocios /</span> Listado de Negocios</h4>
        </div>
        <ul
          class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
          <li class="list-inline-item fw-semibold">
            <button type="button" class="btn rounded-pill btn-icon text-warning" data-bs-toggle="tooltip"
                    data-bs-offset="0,4"
                    data-bs-placement="top" data-bs-html="true" title="Ayuda">
              <span class="tf-icons bx bx-help-circle bx-sm"></span>
            </button>
          </li>
          <li class="list-inline-item fw-semibold">
            <button class="nav-link btn btn-primary" type="button" href="{{url('clientes/cliente-create')}}"><span
                class="tf-icons bx bx-plus"></span> Agregar
            </button>
          </li>
          <li class="list-inline-item fw-semibold">
            <a class="nav-link btn btn-outline-danger" type="button" href="{{url('clientes/cliente')}}"><span
                class="tf-icons bx bx-arrow-back"></span> <span class="d-none d-sm-inline-block">Atrás</span></a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xl-4 col-lg-5 col-md-5 order-0 order-md-0">
      <!-- User Card -->
      <div class="card mb-4">
        <div class="card-body">
          <div class="user-avatar-section">
            <div class=" d-flex align-items-center flex-column">
              <div class="user-info text-center">
                <h4 class="mb-2">Violeta Mendoza</h4>
                <span class="badge bg-label-success">Activo</span>
              </div>
            </div>
          </div>

          <h5 class="pb-2 border-bottom mb-4">Información</h5>
          <div class="info-container">
            <ul class="list-unstyled">
              <li class="mb-3">
                <span class="fw-bold me-2">DUI:</span>
                <span>09897832-3</span>
              </li>
              <li class="mb-3">
                <span class="fw-bold me-2">Nombre:</span>
                <span>Sandra Violeta</span>
              </li>
              <li class="mb-3">
                <span class="fw-bold me-2">Apellidos:</span>
                <span>Mendoza Quezada</span>
              </li>
              <li class="mb-3">
                <span class="fw-bold me-2">Fecha de nacimiento:</span>
                <span>23 de Julio de 1993</span>
              </li>
              <li class="mb-3">
                <span class="fw-bold me-2">Dirección:</span>
                <span>Residencial Villas del Tempisque 3ra Calle oriente Casa #8-A</span>
              </li>
              <li class="mb-3">
                <span class="fw-bold me-2">Teléfono:</span>
                <span>7789-2341</span>
              </li>
              <li class="mb-3">
                <span class="fw-bold me-2">Correo electrónico:</span>
                <span>sandra.violeta@gmail.com</span>
              </li>
            </ul>

          </div>
        </div>
      </div>
      <!-- /User Card -->
    </div>

    <div class="col-xl-8 col-lg-7 col-md-7 order-1 order-md-1">

      <!-- Project table -->
      <div class="card mb-4">
        <h5 class="card-header">Negocios</h5>
        <div class="table-responsive mb-3">
          <div class="table-responsive text-nowrap">
            <table class="table table-hover border-top">
              <thead>
              <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Acciones</th>
              </tr>
              </thead>
              <tbody class="table-border-bottom-0">
              <tr>
                <td>1</td>
                <td>Tortas Divino Niño</td>
                <td>2390-4321</td>
                <td>San Vicente, 5ta calle poniente</td>
                <td>
                  <div class="dropdown-icon-demo">
                    <button type="button" class="btn btn-outline-info dropdown-toggle btn-sm hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="bx bx-menu"></i>
                    </button>
                    <div class="dropdown-menu" style="">
                      <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalEditarSocio"><i class="bx bx-edit-alt me-1"></i> Editar</a>
                      <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Borrar</a>
                    </div>
                  </div>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /Project table -->

    </div>
  </div>

@endsection
