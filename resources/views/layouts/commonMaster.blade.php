<!DOCTYPE html>

<html lang="es" class="light-style layout-menu-fixed" data-theme="theme-default" data-assets-path="{{ asset('/assets') . '/' }}" data-base-url="{{url('/')}}" data-framework="laravel" data-template="vertical-menu-laravel-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>@yield('title') | SICREFI </title>

  <!-- laravel CRUD token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

  <!-- Include Styles -->
  @include('layouts/sections/styles')

  <!-- Include Scripts for customizer, helper, analytics, config -->
  @include('layouts/sections/scriptsIncludes')
  <style>

    .background-loader {
      background: rgba(0, 0, 0, 0.2);
      color: #fff;
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      width: 100vw;
      transition: all .5s;
      z-index: 9999;
    }

    .loader {
      position: absolute;
      top: 50%;
      left: 50%;
    }

  </style>
</head>

<body>




  <!-- Layout Content -->
  @yield('layoutContent')
  <!--/ Layout Content -->

{{-- Background transparente --}}

  <div class="background-loader">
    <div class="spinner-border spinner-border-lg text-primary loader"></div>
  </div>

  <!-- Include Scripts -->
  @include('layouts/sections/scripts')

<script>
  $(document).ready(function() {
    $('.background-loader').fadeOut('slow');
  });

  $(document).on('click', '.load', function() {
    $('.background-loader').fadeIn('slow');
  });

</script>
</body>

</html>
