@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts.contentNavbarLayout')
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

            <button type="button" class="btn rounded-pill btn-icon btn-warning"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd" aria-controls="offcanvasEnd"
                    data-bs-offset="0,4"
                    data-bs-placement="top" data-bs-html="true" title="Ayuda">
              <span class="tf-icons bx bx-question-mark"></span>
            </button>
          </li>
          <li class="list-inline-item fw-semibold">
            <button class="nav-link btn btn-primary" type="button"
                    data-bs-toggle="modal" data-bs-target="#nuevoModal"><span
                class="tf-icons bx bx-plus"></span> Agregar
            </button>
          </li>
          <li class="list-inline-item fw-semibold">
            <a class="nav-link btn btn-secondary" type="button"
               href="{{ route('clientes.listado') }}"><span
                class="tf-icons bx bx-arrow-back"></span> <span class="d-none d-sm-inline-block"> Atrás</span></a>
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
                    <button type="button"
                            class="btn btn-outline-info dropdown-toggle btn-sm hide-arrow"
                            data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="bx bx-menu"></i>
                    </button>
                    <div class="dropdown-menu" style="">
                      <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                         data-bs-target="#nuevoModal">
                        <i class="bx bx-edit-alt me-1"></i>
                        Editar
                      </a>
                      <a class="dropdown-item" href="javascript:void(0);">
                        <i class="bx bx-trash me-1"></i> Borrar
                      </a>
                    </div>
                  </div>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal de agregar y editar --}}
  <div class="modal fade" id="nuevoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-lg-down modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white">Nuevo negocio</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="" class="form-label">Nombre (*)</label>
              <input type="text" id="" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
              <label for="" class="form-label">Teléfono (*)</label>
              <input type="text" id="" class="form-control" placeholder="0000-0000">
            </div>

            <div class="col-md-4 mb-3">
              <label for="" class="form-label">Tiempo de tenerlo (*)</label>
              <input type="text" id="" class="form-control" placeholder="Cantidad en años">
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 mb-3">
              <label class="form-label" for="">Dirección (*)</label>
              <textarea class="form-control" id="" rows="1"></textarea>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="" class="form-label">Venta en dia bueno (*)</label>
              <input type="text" id="" class="form-control" placeholder="0.00">
            </div>

            <div class="col-md-4 mb-3">
              <label for="" class="form-label">Venta en dia malo (*)</label>
              <input type="text" id="" class="form-control" placeholder="0.00">
            </div>

            <div class="col-md-4 mb-3">
              <label for="" class="form-label">Ganancia diaria (*)</label>
              <input type="text" id="" class="form-control" placeholder="0.00">
            </div>


          </div>

          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="" class="form-label">Inversión diaria (*)</label>
              <input type="text" id="" class="form-control" placeholder="0.00">
            </div>

            <div class="col-md-4 mb-3">
              <label for="" class="form-label">Pago de empleados (*)</label>
              <input type="text" id="" class="form-control" placeholder="0.00">
            </div>

            <div class="col-md-4 mb-3">
              <label for="" class="form-label">Alquiler de local (*)</label>
              <input type="text" id="" class="form-control" placeholder="0.00">
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="" class="form-label">Impuestos (*)</label>
              <input type="text" id="" class="form-control" placeholder="0.00">
            </div>

            <div class="col-md-4 mb-3">
              <label for="" class="form-label">Otros pagos (*)</label>
              <input type="text" id="" class="form-control" placeholder="0.00">
            </div>

            <div class="col-md-4 mb-3">
              <label for="" class="form-label">Cuotas de créditos (*)</label>
              <input type="text" id="" class="form-control" placeholder="0.00">
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 mb-3 text-end">
              Los campos marcados con <span class="text-danger">(*)</span> son obligatorios
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary me-sm-3 me-1 mt-3"><span
              class="tf-icons bx bx-save"></span> Guardar
          </button>
          <button type="reset" class="btn btn-label-secondary btn-reset mt-3" data-bs-dismiss="modal"
                  aria-label="Close">Cerrar
          </button>
        </div>
      </div>
    </div>
  </div>

  {{-- Off canvas de Ayuda --}}
  <div class="mt-3">
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel">
      <div class="offcanvas-header">
        <h5 id="offcanvasEndLabel" class="offcanvas-title">Sección de Ayuda</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>

      <div class="offcanvas-body mx-0 flex-grow-0">
        <h5>¿Cómo registrar un nuevo negocio?</h5>
        <iframe src="https://www.youtube.com/embed/xcJtL7QggTI?si=ox0HflKK3Jy9A4qJ"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>

        <h5 class="mt-2">¿Cómo modificar los datos de un negocio?</h5>
        <iframe src="https://www.youtube.com/embed/xcJtL7QggTI?si=ox0HflKK3Jy9A4qJ"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>

        <h5 class="mt-2">¿Cómo eliminar un negocio?</h5>
        <iframe src="https://www.youtube.com/embed/xcJtL7QggTI?si=ox0HflKK3Jy9A4qJ"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>
      </div>
    </div>
  </div>

@endsection
