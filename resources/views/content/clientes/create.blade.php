@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Nuevo Cliente')
@section('content')
  <form action="{{ route('clientes.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
    @csrf {{-- Security --}}
    @include('content.clientes.form')
  </form>

@endsection

@section('page-script')
  <script src="{{ asset('assets/js/cliente.js') }}"></script>
@endsection
