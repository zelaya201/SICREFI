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
        @if($errors->any())
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $errors->first() }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @elseif(session('success'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <!-- Register -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center mb-3">
                <span class="app-brand-logo">
                  <img src="{{ asset('assets/img/logo/logo.png') }}" width="25" alt="Brand Logo" class="img-fluid">
                </span>
                <span class="app-brand-text text-uppercase demo menu-text fw-bold m-0">
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

            <form id="formAuthentication" class="mb-3" action="" method="POST">
              @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Usuario o correo electrónico</label>
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
                  <label class="form-label" for="password">Contraseña</label>
                  <a href="{{ route('resetPassword') }}" class="load">
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
                <button class="btn btn-primary d-grid w-100 load" type="submit">Iniciar sesión</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /Register -->
    </div>
  </div>
@endsection
