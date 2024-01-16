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

            @foreach($errors as $error)
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endforeach

            @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Exito!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            <form id="formAuthentication" class="mb-3" action="" method="POST">
              @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Usuario o correo electronico</label>
                <input type="text" class="form-control @error('email-usernae') is-invalid @enderror" id="email" name="email-username"
                       value="{{ old('email-username') }}"
                       placeholder="" autofocus>
                @error('email-username')
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                  <div data-field="name" data-validator="notEmpty" id="id_rol_error">{{ $message }}</div>
                </div>
                @enderror
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label" for="password">Password</label>
                  <a href="{{ route('resetPassword') }}">
                    <small>¿Olvidaste tu contraseña?</small>
                  </a>
                </div>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control"
                         value="{{ old('password') }}"
                         name="password" placeholder="************"
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
