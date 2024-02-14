@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Copias de seguridad')
@section('content')
  <div class=" flex-grow-1 py-3">
    <div
      class="d-flex align-items-center justify-content-md-between justify-content-start flex-md-row flex-column mb-4">
      <div class="user-profile-info py-1">
        <h4 class="fw-bold m-0"><span class="text-muted fw-light">Copias de seguridad /</span> Base de datos</h4>
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

      </ul>
    </div>

    @if(Session::has('success'))
      <div class="alert alert-primary d-flex" role="alert">
          <span class="badge badge-center rounded-pill bg-primary border-label-primary p-3 me-2"><i
              class="bx bx-user fs-6"></i></span>
        <div class="d-flex flex-column ps-1">
          <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Exito</h6>
          <span>{{ Session::get('success') }}</span>
        </div>
      </div>
    @endif

    <div class="row">
      <div class="col-lg-6 mb-4">
        <div class="card">
          <div class="card-header pb-0">
            <span class="fw-bold">Crear copia de seguridad</span>
            <hr class="my-2">
          </div>
          <div class="card-body">

            <div class="row">
              <div class="col-md-12">
                <a class="btn btn-info w-auto" type="button" href="{{ route('seguridad.create') }}"><span
                    class="tf-icons bx bx-cloud-download"></span> <span class="d-none d-sm-inline-block"> Generar copia de seguridad</span>
                </a>
              </div>
              <small>Se generará la copia de seguridad de hoy {{ date('d-m-Y') }} </small>
            </div>
          </div>
        </div>
      </div>


        <div class="col-lg-6 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <span class="fw-bold">Restaurar copia de seguridad</span>
              <hr class="my-2">
            </div>
            <div class="card-body">
              <form action="{{ route('seguridad.restore') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                <div class="col-md-12">
                  <input type="file" class="form-control" accept=".sql" name="file">
                </div>
                <small>Tipos de archivos admitidos: .sql</small>

                <div class="col-md-12 mt-3">
                  <button class="btn btn-primary w-auto" type="submit"><span
                      class="tf-icons bx bx-cloud-upload"></span> <span class="d-none d-sm-inline-block"> Restaurar copia de seguridad</span>
                  </button>
                </div>

              </div>
              </form>
            </div>
          </div>
        </div>
    </div>

@endsection

@section('page-script')
@endsection
