@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Nuevo Cliente')
@section('content')
  <form action="{{ route('clientes.store') }}" method="post" enctype="multipart/form-data">
    @csrf {{-- Security --}}

  @include('content.clientes.form')

@endsection
