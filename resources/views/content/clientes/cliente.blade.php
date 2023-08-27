@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Clientes')
@section('content')
  <div class="d-flex align-items-center justify-content-between py-3">
    <h4 class="fw-bold py-1 m-0"><span class="text-muted fw-light">Clientes /</span> Cartera de Clientes</h4>
    <a class="btn btn-primary" type="button" href="{{ route("clientes.nuevo")  }}"><span
        class="tf-icons bx bx-plus"></span> Nuevo Cliente</a>
  </div>
@endsection
