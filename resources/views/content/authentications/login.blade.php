@extends('layouts/blankLayout')

@section('title', 'Iniciar sesión')

@section('page-style')
  <!-- Page -->
  <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center mb-3">
                <span class="app-brand-logo demo">
                  <span class="tf-icons bx bxs-coin-stack"></span>
                </span>
                <span class="app-brand-text text-uppercase demo menu-text fw-bold ms-2">
                  <span class="text-secondary">SI</span><span class="text-primary">CREFI</span>
                </span>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2 text-center">Inicio de sesión</h4>
            <p class="mb-4">Por favor inicia sesión con tus credenciales</p>

            <form id="formAuthentication" class="mb-3" action="{{url('/')}}" method="GET">
              <div class="mb-3">
                <label for="email" class="form-label">Usuario o correo electronico</label>
                <input type="text" class="form-control" id="email" name="email-username" placeholder="" autofocus>
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                  <a href="{{ route('resetPassword') }}">
                    <small>¿Olvidaste tu contraseña?</small>
                  </a>
                </div>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password" placeholder="************"
                         aria-describedby="password"/>
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>

              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Iniciar sesión</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /Register -->
    </div>
  </div>
@endsection
