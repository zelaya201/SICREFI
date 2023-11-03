@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Créditos')
@section('content')
  <div class=" flex-grow-1 py-3">
    <div
      class="d-flex align-items-center justify-content-md-between justify-content-start flex-md-row flex-column mb-4">
      <div class="user-profile-info py-1">
        <h4 class="fw-bold m-0"><span class="text-muted fw-light">Créditos /</span> Cartera de créditos</h4>
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
          <a class="nav-link btn btn-primary" type="button" href="{{ route('creditos.create') }}"><span
              class="tf-icons bx bx-plus"></span> <span class="d-none d-sm-inline-block"> Nuevo crédito</span> </a>
        </li>
      </ul>
    </div>

    @if(Session::has('success'))
      <div class="alert alert-primary d-flex" role="alert">
          <span class="badge badge-center rounded-pill bg-primary border-label-primary p-3 me-2"><i
              class="bx bx-user fs-6"></i></span>
        <div class="d-flex flex-column ps-1">
          <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Mensaje de éxito</h6>
          <span>{{ Session::get('mensaje') }}</span>
        </div>
      </div>
  @endif



@endsection

@section('page-script')

@endsection
