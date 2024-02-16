@extends('layouts/blankLayout')

@section('title', 'Reestablecer contraseña')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">

      @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ $errors->first() }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @elseif(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Exito!</strong> {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif



      <!-- Forgot Password -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center mb-3">
                <span class="app-brand-logo demo">
                  <img src="{{ asset('assets/img/logo/logo.png') }}" width="25" alt="Brand Logo" class="img-fluid">
                </span>
            <span class="app-brand-text text-uppercase demo menu-text fw-bold m-0">
                  <span class="text-secondary">SI</span><span class="text-primary">CREFI</span>
                </span>
          </div>
          <!-- /Logo -->
          <h4 class="mb-2 text-center">Reestablecer contraseña</h4>
            <p class="mb-4">Ingresa el correo electrónico asociado a tu cuenta para reestablecer tu contraseña.</p>
          <form id="formAuthentication" class="mb-3" action="{{ route('sendMail') }}" method="POST">
            @csrf



            <div class="mb-3">
              <label for="email_usuario" class="form-label">Correo electrónico</label>
              <input type="text" class="form-control" id="email_usuario" name="email_usuario" placeholder="ejemplo@ejemplo.com" autofocus>
            </div>
            <button type="submit" class="btn btn-primary d-grid w-100 load">Enviar correo electrónico</button>
          </form>
          <div class="text-center">
            <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center load">
              <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
              Regresar a inicio de sesión
            </a>
          </div>
        </div>
      </div>
      <!-- /Forgot Password -->
    </div>
  </div>
</div>
@endsection
