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
               href="{{ route('clientes.index') }}"><span
                class="tf-icons bx bx-arrow-back"></span> <span class="d-none d-sm-inline-block"> Atrás</span></a>
          </li>
        </ul>
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
