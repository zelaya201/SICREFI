@extends('layouts/blankLayout')

@section('title', 'Cambiar contraseña')

@section('page-style')
  <!-- Page -->
  <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-4">

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
            <h4 class="mb-2 text-center mt-0">Cambiar contraseña</h4>
            <p class="mb-4"></p>
            <form id="formAuthentication" class="mb-3" action="{{ route('updatePassword') }}" method="POST">
              @csrf

              <input type="hidden" value="{{ $token }}" name="token">

              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Nueva contraseña</label>
                </div>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password" placeholder="************"
                         aria-describedby="password"/>
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>

              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password_confirmation">Repetir contraseña</label>
                </div>
                <div class="input-group input-group-merge">
                  <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="************"
                         aria-describedby="password"/>
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>
              <button class="btn btn-primary d-grid w-100 load" disabled>Cambiar contraseña</button>
            </form>
            <div class="text-center">
              <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm load"></i>
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

@section('page-script')
  <!-- Page js files -->
  <script>
    password = $('#password');
    password_confirmation = $('#password_confirmation');

    // Verificar que las contraseñas coincidan
    password_confirmation.on('keyup', function () {
      validatePassword();
    });

    password.on('keyup', function () {
      validatePassword();
    });

    function validatePassword() {
      if (password.val() === password_confirmation.val() && password.val() !== '' && password_confirmation.val() !== '') {
        password_confirmation.removeClass('is-invalid');
        password_confirmation.addClass('is-valid');

        password.removeClass('is-invalid');
        password.addClass('is-valid');

        $('#formAuthentication button').prop('disabled', false);
      } else {
        password_confirmation.removeClass('is-valid');
        password_confirmation.addClass('is-invalid');

        password.removeClass('is-valid');
        password.addClass('is-invalid');

        $('#formAuthentication button').prop('disabled', true);
      }
    }


  </script>
@endsection
