@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Nuevo Cliente')
@section('content')
  <form action="{{ route('clientes.store') }}" method="post" autocomplete="off" enctype="multipart/form-data" id="form-cliente">
    @csrf {{-- Security --}}
    @include('content.clientes.form')
  </form>

@endsection

@section('page-script')
  <script src="{{ asset('assets/js/cliente.js') }}"></script>
  <script>
    $(document).ready(function (){

      $('#btn-guardar-cliente').click(function (e) {

        e.preventDefault();

        $.ajax({
          url: '{{ route("clientes.store") }}',
          type: 'post',
          dataType: 'json',
          data: $('#form-cliente').serialize(),
          success: function (data){
            /* Mensaje de exito */

          },
          error: function (xhr) {

            /* Remover errores */
            var inputs = $('#form-cliente').find('input, select, textarea');

            inputs.change(function () {
              $(this).removeClass('is-invalid'); //Eliminar clase 'is-invalid'
            });

            var data = xhr.responseJSON;
            if($.isEmptyObject(data.errors) === false) {
              $.each(data.errors, function (key, value) {
                // Mostrar errores en los inputs
                $('#' + key).addClass('is-invalid');
                $('#' + key + '_error').html(value); // Agregar el mensaje de error
              });
            }
          }
        });
      });
    });
  </script>
@endsection
