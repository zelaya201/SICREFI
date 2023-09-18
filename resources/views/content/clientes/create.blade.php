@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Nuevo Cliente')
@section('content')
  <form action="{{ route('clientes.store') }}" method="post" autocomplete="off" enctype="multipart/form-data" id="form-cliente">


  <div class="d-flex align-items-center justify-content-between py-3">
    <div class="flex-grow-1">
      <div
        class="d-flex align-items-center justify-content-md-between justify-content-start flex-md-row flex-column gap-4">
        <div class="user-profile-info">
          <h4 class="fw-bold m-0"><span class="text-muted fw-light">Clientes /</span> Nuevo Cliente</h4>
        </div>
        <ul
          class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
          <li class="list-inline-item fw-semibold">
            <button type="button" class="btn rounded-pill btn-icon btn-warning"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd" aria-controls="offcanvasEnd"
                    data-bs-offset="0,4"
                    data-bs-placement="top" data-bs-html="true" title="Ayuda">
              <span class="tf-icons bx bx-question-mark"></span>
            </button>
          </li>
          <li class="list-inline-item fw-semibold">

            <button class="nav-link btn btn-primary" type="button" id="btn-guardar-cliente">
              <span class="tf-icons bx bx-save"></span>
              Guardar
            </button>
          </li>
          <li class="list-inline-item fw-semibold">
            <a class="nav-link btn btn-secondary" type="button" href="{{ route('clientes.index') }}"> Cancelar
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  {{-- Navegación de Formulario --}}
  <ul class="nav nav-pills nav-align-left nav-card-header-pills align-items-center" role="tablist">
    <li class="nav-item" role="presentation">
      <button type="button" class="btn step active" role="tab" data-bs-toggle="tab"
              data-bs-target="#card-datos-cliente" aria-controls="card-datos-cliente" aria-selected="true">
        <span class="badge bg-label-secondary"><i class="bx bx-user"></i></span>
        <span class="bs-stepper-title">Información</span>
      </button>
    </li>
    <li>
      <div class="line d-none d-md-inline-block align-items-baseline">
        <i class="bx bx-chevron-right"></i>
      </div>
    </li>
    <li class="nav-item" role="presentation">
      <button type="button" class="btn step" role="tab" data-bs-toggle="tab" data-bs-target="#card-conyuge"
              aria-controls="card-conyuge" aria-selected="false" tabindex="-1">
        <span class="badge bg-label-secondary"><i class="bx bx-user-check"></i></span>

        <span class="bs-stepper-label mt-1">
        <span class="bs-stepper-title">Conyuge</span>
      </span>
      </button>
    </li>
    <li>
      <div class="line d-none d-md-inline-block align-items-baseline">
        <i class="bx bx-chevron-right"></i>
      </div>
    </li>
    <li class="nav-item" role="presentation">
      <button type="button" class="btn step" role="tab" data-bs-toggle="tab" data-bs-target="#card-datos-negocios"
              aria-controls="card-datos-negocios" aria-selected="false" tabindex="-1">
        <span class="badge bg-label-secondary"><i class="bx bx-store-alt"></i></span>

        <span class="bs-stepper-label mt-1">
        <span class="bs-stepper-title">Negocio</span>
      </span>
      </button>
    </li>
    <li>
      <div class="line d-none d-md-inline-block align-items-baseline">
        <i class="bx bx-chevron-right"></i>
      </div>
    </li>

    <li class="nav-item" role="presentation">
      <button type="button" class="btn step" role="tab" data-bs-toggle="tab" data-bs-target="#card-referencia"
              aria-controls="card-referencia" aria-selected="false" tabindex="-1">
        <span class="badge bg-label-secondary"><i class="bx bx-user-plus"></i></span>

        <span class="bs-stepper-label mt-1">
        <span class="bs-stepper-title">Referencias</span>
    </span>
      </button>
    </li>
    <li>
      <div class="line d-none d-md-inline-block align-items-baseline">
        <i class="bx bx-chevron-right"></i>
      </div>
    </li>
    <li class="nav-item" role="presentation">
      <button type="button" class="btn step" role="tab" data-bs-toggle="tab" data-bs-target="#card-bienes"
              aria-controls="card-bienes" aria-selected="false" tabindex="-1">
        <span class="badge bg-label-secondary"><i class="bx bx-buildings"></i></span>

        <span class="bs-stepper-label mt-1">
        <span class="bs-stepper-title">Bienes</span>
      </span>
      </button>
    </li>
  </ul>

  <!-- Datos del Cliente -->
  <div class="tab-content p-0">
    @include('content.clientes._partials.info') {{-- Información del cliente --}}

    @include('content.clientes._partials.conyuge') {{-- Información del conyuge --}}

    @include('content.clientes._partials.negocios') {{-- Información de los negocios --}}

    @include('content.clientes._partials.referencias') {{-- Información de las referencias --}}

    @include('content.clientes._partials.bienes') {{-- Información de los bienes --}}
  </div>
  </form>

  {{-- Off canvas de Ayuda--}}
  {{--<div class="mt-3">--}}
  {{--  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel">--}}
  {{--    <div class="offcanvas-header">--}}
  {{--      <h5 id="offcanvasEndLabel" class="offcanvas-title">Sección de Ayuda</h5>--}}
  {{--      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>--}}
  {{--    </div>--}}

  {{--    <div class="offcanvas-body mx-0 flex-grow-0">--}}
  {{--      <h5>¿Cómo registrar un nuevo cliente?</h5>--}}
  {{--      <iframe src="https://www.youtube.com/embed/xcJtL7QggTI?si=ox0HflKK3Jy9A4qJ"--}}
  {{--              title="YouTube video player" frameborder="0"--}}
  {{--              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"--}}
  {{--              allowfullscreen></iframe>--}}
  {{--    </div>--}}
  {{--  </div>--}}
  {{--</div>--}}

@endsection

@section('page-script')


  {{-- Guardar Cliente y todos sus datos --}}
  <script>
    $(document).ready(function () {

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      /** EVENTOS DE BOTONES CLIENTE **/
      $('#btn-guardar-cliente').click(function (e) {
        e.preventDefault();

        $.ajax({
          url: '{{ route("clientes.store") }}',
          type: 'post',
          dataType: 'json',
          data: $('#form-cliente').serialize(),
          success: function (data) {
            /* Mensaje de exito */
            if(data.success){
              window.location.href = '{{ route("clientes.index") }}';
            }
          },
          error: function (xhr) {
            /* Remover errores */
            var inputs = $('#form-cliente').find('input, select, textarea');

            inputs.change(function () {
              $(this).removeClass('is-invalid'); //Eliminar clase 'is-invalid'
            });

            var data = xhr.responseJSON;
            if ($.isEmptyObject(data.errors) === false) {
              $.each(data.errors, function (key, value) {
                // Mostrar errores en los inputs
                $('#' + key).addClass('is-invalid');
                $('#' + key + '_error').html(value); // Agregar el mensaje de error
              });
            }
          }
        });
      });
      /** FIN EVENTOS DE BOTONES CLIENTE **/


      /** EVENTOS DE BOTONES NEGOCIO **/
      $('#btn-nuevo-negocio').click(function (e) {
        e.preventDefault();
        $('#titulo-modal-negocio').html('Nuevo Negocio');
        $('#form-negocio').trigger('reset');
        $('#btn-agregar-negocio').html('Agregar');
        $('#lista-telefonos-negocio').html('<tr><td colspan="3">No hay resultados</td></tr>');

        $.ajax({
          url: '{{ route("telsNegocio.store") }}',
          type: 'post',
          dataType: 'json',
          data: 'opcion=limpiar',
          success: function (data) {
            /* Mensaje de exito */
            mostrarTelefonosNegocio(data);
          },
          error: function (xhr) {
            /* Mensajes de error */
          }
        });
      });

      $('#btn-agregar-negocio').click(function (e) {
        e.preventDefault();
          var datos = $('#form-negocio').serialize();
          let id_negocio = $('#id_negocio').val();

          if(id_negocio !== ''){
            datos += '&opcion=actualizar';
            datos += '&id=' + id_negocio;
            datos += '&session=true';

            $.ajax({
              url: '{{ route("negocios.store") }}',
              type: 'post',
              dataType: 'json',
              data: datos,
              success: function (data) {
                /* Mensaje de exito */
                $('#modal-negocio').modal('hide');
                $('#form-negocio').trigger('reset');
                mostrarNegocios(data);
              },
              error: function (xhr) {
                /* Mensajes de error */
              }
            });
          }else{
            datos += '&opcion=agregar';
            datos += '&session=true';

            $.ajax({
              url: '{{ route("negocios.store") }}',
              type: 'post',
              dataType: 'json',
              data: datos,
              success: function (data) {
                /* Mensaje de exito */
                $('#modal-negocio').modal('hide');
                $('#form-negocio').trigger('reset');
                mostrarNegocios(data);
              },
              error: function (xhr) {
                /* Mensajes de error */
              }
            });
          }
      })
      /** FIN EVENTO DE BOTONES NEGOCIO **/


      /** EVENTOS DE BOTONES REFERENCIA **/
      $('#btn-agregar-ref').click(function (e) {
        e.preventDefault();
        var datos = $('#form-ref').serialize();
        let id_ref = $('#id_ref').val();

        if(id_ref !== ''){
          datos += '&opcion=actualizar';
          datos += '&id=' + id_ref;
          datos += '&session=true';

          $.ajax({
            url: '{{ route("referencias.store") }}',
            type: 'post',
            dataType: 'json',
            data: datos,
            success: function (data) {
              /* Mensaje de exito */
              $('#modal-ref').modal('hide');
              $('#form-ref').trigger('reset');

              mostrarRef(data);
            },
            error: function (xhr) {
              /* Mensajes de error */
            }
          });
        }else{
          datos += '&opcion=agregar';
          datos += '&session=true';

          $.ajax({
            url: '{{ route("referencias.store") }}',
            type: 'post',
            dataType: 'json',
            data: datos,
            success: function (data) {
              /* Mensaje de exito */
              $('#modal-ref').modal('hide');
              $('#form-ref').trigger('reset');
              mostrarRef(data);
            },
            error: function (xhr) {
              /* Mensajes de error */
            }
          });
        }
      });

      $('#btn-nuevo-ref').click(function (e) {
        e.preventDefault();
        $('#titulo-modal-ref').html('Nueva Referencia');
        $('#form-ref').trigger('reset');
        $('#btn-agregar-ref').html('Agregar');
        $('#lista-telefonos-ref').html('<tr><td colspan="3">No hay resultados</td></tr>');

        $.ajax({
          url: '{{ route("telsReferencia.store") }}',
          type: 'post',
          dataType: 'json',
          data: 'opcion=limpiar',
          success: function (data) {
            /* Mensaje de exito */
            mostrarTelefonosReferencia(data);
          },
          error: function (xhr) {
            /* Mensajes de error */
          }
        });
      });
      /** FIN EVENTOS DE BOTONES REFERENCIA **/

      /** EVENTOS DE BOTONES BIEN **/
      $('#btn-nuevo-bien').click(function (e) {
        e.preventDefault();
        $('#titulo-modal-bien').html('Nuevo Bien');
        $('#form-bien').trigger('reset');
        $('#btn-agregar-bien').html('Agregar');
      });

      $('#btn-agregar-bien').click(function (e) {
        e.preventDefault();
        var datos = $('#form-bien').serialize();
        let id_bien = $('#id_bien').val();

        if(id_bien !== ''){
          datos += '&opcion=actualizar';
          datos += '&id=' + id_bien;
          datos += '&session=true';

          $.ajax({
            url: '{{ route("bienes.store") }}',
            type: 'post',
            dataType: 'json',
            data: datos,
            success: function (data) {
              /* Mensaje de exito */
              $('#modal-bien').modal('hide');
              $('#form-bien').trigger('reset');
              mostrarBienes(data);
            },
            error: function (xhr) {
              /* Mensajes de error */
            }
          });
        }else{
          datos += '&opcion=agregar';
          datos += '&session=true';

          $.ajax({
            url: '{{ route("bienes.store") }}',
            type: 'post',
            dataType: 'json',
            data: datos,
            success: function (data) {
              /* Mensaje de exito */
              $('#modal-bien').modal('hide');
              $('#form-bien').trigger('reset');
              mostrarBienes(data);
            },
            error: function (xhr) {
              /* Mensajes de error */
            }
          });
        }
      });
      /** FIN EVENTOS DE BOTONES BIEN **/

      /** EVENTOS DE BOTONES TELEFONO CLIENTE **/
      $('#btn-agregar-telefono-cliente').click(function (e) {
        e.preventDefault();

        let datos = 'tel_cliente=' + $('#tel_cliente').val();
        datos += '&opcion=agregar';
        datos += '&session=true';

        $.ajax({
          url: '{{ route("telsCliente.store") }}',
          type: 'post',
          dataType: 'json',
          data: datos,
          success: function (data) {
            /* Mensaje de exito */
            $('#telefono-modal-cliente').modal('hide');
            $('#tel_cliente').val('');
            mostrarTelefonosCliente(data);
          },
          error: function (xhr) {
            /* Mensajes de error */
          }
        });
      });
      /** FIN EVENTOS DE BOTONES TELEFONO CLIENTE **/

      /** EVENTOS DE BOTONES TELEFONO CONYUGE **/
      $('#btn-agregar-telefono-conyuge').click(function (e) {
        e.preventDefault();

        var datos = $('#form-telsconyuge').serialize();
        datos += '&opcion=agregar';
        datos += '&session=true';

        $.ajax({
          url: '{{ route("telsConyuge.store") }}',
          type: 'post',
          dataType: 'json',
          data: datos,
          success: function (data) {
            /* Mensaje de exito */
            $('#telefono-modal-conyuge').modal('hide');
            $('#form-telsconyuge').trigger('reset');
            mostrarTelefonosConyuge(data);
          },
          error: function (xhr) {
            /* Mensajes de error */
          }
        });
      });
      /** FIN EVENTOS DE BOTONES TELEFONO CONYUGE **/

      /** EVENTOS DE BOTONES TELEFONO NEGOCIO **/
      $('#btn-agregar-telefono-negocio').click(function (e) {
        e.preventDefault();

        let datos = 'tel_negocio=' + $('#tel_negocio').val();
        datos += '&opcion=agregar';
        datos += '&session=true';

        $.ajax({
          url: '{{ route("telsNegocio.store") }}',
          type: 'post',
          dataType: 'json',
          data: datos,
          success: function (data) {
            /* Mensaje de exito */
            $('#tel_negocio').val('');
            mostrarTelefonosNegocio(data);
          },
          error: function (xhr) {
            /* Mensajes de error */
          }
        });
      });
      /** FIN EVENTOS DE BOTONES TELEFONO NEGOCIO **/

      /** EVENTOS DE BOTONES TELEFONO REFERENCIA **/
      $('#btn-agregar-telefono-referencias').click(function (e) {
        e.preventDefault();

        let datos = 'tel_ref=' + $('#tel_ref').val();
        datos += '&opcion=agregar';
        datos += '&session=true';

        $.ajax({
          url: '{{ route("telsReferencia.store") }}',
          type: 'post',
          dataType: 'json',
          data: datos,
          success: function (data) {
            /* Mensaje de exito */
            $('#tel_ref').val('');
            mostrarTelefonosReferencia(data);
          },
          error: function (xhr) {
            /* Mensajes de error */
          }
        });
      });
      /** FIN EVENTOS DE BOTONES TELEFONO REFERENCIA **/

    });

    /** FUNCIONES DE NEGOCIO **/
    function eliminarNegocio(id) {
      var datos = $('#form-negocio').serialize();
      datos += '&opcion=eliminar';
      datos += '&id=' + id;
      datos += '&session=true';

      $.ajax({
        url: '{{ route("negocios.store") }}',
        type: 'post',
        dataType: 'json',
        data: datos,
        success: function (data) {
          /* Mensaje de exito */
          $('#modal-negocio').modal('hide');
          $('#form-negocio').trigger('reset');
          mostrarNegocios(data);
        },
        error: function (xhr) {
          /* Mensajes de error */
        }
      });
    }

    function obtenerNegocio(id){
      var datos = $('#form-negocio').serialize();
      datos += '&opcion=obtener';
      datos += '&id=' + id;
      datos += '&session=true';

      $.ajax({
        url: '{{ route("negocios.store") }}',
        type: 'post',
        dataType: 'json',
        data: datos,
        success: function (data) {
          /* Mensaje de exito */
          $('#titulo-modal-negocio').html('Editar Negocio');

          $('#modal-negocio').modal('show');
          $('#form-negocio').trigger('reset');
          $('#btn-agregar-negocio').html('Modificar');

          $('#id_negocio').val(data.id);
          $('#nom_negocio').val(data.nom_negocio);
          $('#dir_negocio').val(data.dir_negocio);
          $('#tiempo_negocio').val(data.tiempo_negocio);
          $('#buena_venta_negocio').val(data.buena_venta_negocio);
          $('#mala_venta_negocio').val(data.mala_venta_negocio);
          $('#ganancia_diaria_negocio').val(data.ganancia_diaria_negocio);
          $('#inversion_diaria_negocio').val(data.inversion_diaria_negocio);
          $('#gasto_emp_negocio').val(data.gasto_emp_negocio);
          $('#gasto_alquiler_negocio').val(data.gasto_alquiler_negocio);
          $('#gasto_impuesto_negocio').val(data.gasto_impuesto_negocio);
          $('#gasto_credito_negocio').val(data.gasto_credito_negocio);
          $('#gasto_otro_negocio').val(data.gasto_otro_negocio);

          mostrarTelefonosNegocio(data.telefonos_negocio);
        },
        error: function (xhr) {
          /* Mensajes de error */
        }
      });
    }

    function mostrarNegocios(data) {
      var html = "";

      $.each(data, function (key, value) {
        html += '<tr id="negocio_' + key + '">';
        html += '<td>' + key + '</td>';
        html += '<td>' + value.nom_negocio + '</td>';
        html += '<td>' + value.dir_negocio + '</td>';
        html += '<td>' + value.tiempo_negocio + '</td>';
        html += '<td>';
        html += "<div class='dropdown-icon-demo'> " +
          "<a href='javascript:void(0);' class='btn dropdown-toggle btn-sm hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'>" +
          "<i class='bx bx-dots-vertical-rounded'></i>" +
          "</a> " +
          "<div class='dropdown-menu'>" +
          "<a class='dropdown-item' href='javascript:void(0);' onclick='obtenerNegocio("+ value.id +")'>" +
          "<i class='bx bx-edit-alt me-1'></i>Editar" +
          "</a>" +
          "<div class='dropdown-divider'></div>" +
          "<a class='dropdown-item text-danger' href='javascript:void(0);' onclick='eliminarNegocio(" + value.id + ")'>" +
          "<i class='bx bx-trash me-1'></i> Borrar" +
          "</a>" +
          "</div>" +
          "</div>"
        html += '</td>';
        html += '</tr>';
      });

      if (data.length === 0){
        html += '<tr><td colspan="5">No hay resultados</td></tr>';
      }

      $('#tabla-negocios').html(html);
    }
    /** FIN FUNCIONES DE NEGOCIO **/


    /** FUNCIONES DE REFERENCIA **/
    function eliminarRef(id) {
      var datos = $('#form-ref').serialize();
      datos += '&opcion=eliminar';
      datos += '&id=' + id;
      datos += '&session=true';

      $.ajax({
        url: '{{ route("referencias.store") }}',
        type: 'post',
        dataType: 'json',
        data: datos,
        success: function (data) {
          /* Mensaje de exito */
          $('#modal-ref').modal('hide');
          $('#form-ref').trigger('reset');
          mostrarRef(data);
        },
        error: function (xhr) {
          /* Mensajes de error */
        }
      });
    }

    function obtenerRef(id){
      var datos = $('#form-ref').serialize();
      datos += '&opcion=obtener';
      datos += '&id=' + id;
      datos += '&session=true';

      $.ajax({
        url: '{{ route("referencias.store") }}',
        type: 'post',
        dataType: 'json',
        data: datos,
        success: function (data) {
          /* Mensaje de exito */
          $('#titulo-modal-ref').html('Editar Referencia');

          $('#modal-ref').modal('show');
          $('#form-ref').trigger('reset');
          $('#btn-agregar-ref').html('Modificar');

          $('#id_ref').val(data.id);
          $('#primer_nom_ref').val(data.primer_nom_ref);
          $('#segundo_nom_ref').val(data.segundo_nom_ref);
          $('#tercer_nom_ref').val(data.tercer_nom_ref);
          $('#primer_ape_ref').val(data.primer_ape_ref);
          $('#segundo_ape_ref').val(data.segundo_ape_ref);
          $('#ocupacion_ref').val(data.ocupacion_ref);
          $('#parentesco_ref').val(data.parentesco_ref);
          $('#dir_ref').val(data.dir_ref);

          mostrarTelefonosReferencia(data.telefonos_ref);
        },
        error: function (xhr) {
          /* Mensajes de error */
        }
      });
    }

    function mostrarRef(data) {
      var html = "";

      $.each(data, function (key, value) {
        html += '<tr id="ref_' + key + '">';
        html += '<td>' + key + '</td>';
        html += '<td>' + value.primer_nom_ref + ' ' + value.primer_ape_ref + '</td>';
        html += '<td>' + value.dir_ref + '</td>';
        html += '<td>' + value.ocupacion_ref + '</td>';
        html += '<td>' + value.parentesco_ref + '</td>';
        html += '<td>';
        html += "<div class='dropdown-icon-demo'> " +
          "<a href='javascript:void(0);' class='btn dropdown-toggle btn-sm hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'>" +
          "<i class='bx bx-dots-vertical-rounded'></i>" +
          "</a> " +
          "<div class='dropdown-menu'>" +
          "<a class='dropdown-item' href='javascript:void(0);' onclick='obtenerRef("+ value.id +")'>" +
          "<i class='bx bx-edit-alt me-1'></i>Editar" +
          "</a>" +
          "<div class='dropdown-divider'></div>" +
          "<a class='dropdown-item text-danger' href='javascript:void(0);' onclick='eliminarRef(" + value.id + ")'>" +
          "<i class='bx bx-trash me-1'></i> Borrar" +
          "</a>" +
          "</div>" +
          "</div>"
        html += '</td>';
        html += '</tr>';
      });

      if (data.length === 0){
        html += '<tr><td colspan="6">No hay resultados</td></tr>';
      }

      $('#tabla-ref').html(html);
    }
    /** FIN FUNCIONES DE REFERENCIA **/


    /** FUNCIONES DE BIEN **/
    function eliminarBien(id) {
      var datos = $('#form-bien').serialize();
      datos += '&opcion=eliminar';
      datos += '&id=' + id;
      datos += '&session=true';

      $.ajax({
        url: '{{ route("bienes.store") }}',
        type: 'post',
        dataType: 'json',
        data: datos,
        success: function (data) {
          /* Mensaje de exito */
          $('#modal-bien').modal('hide');
          $('#form-bien').trigger('reset');
          mostrarBienes(data);
        },
        error: function (xhr) {
          /* Mensajes de error */
        }
      });
    }

    function obtenerBien(id){
      var datos = $('#form-bien').serialize();
      datos += '&opcion=obtener';
      datos += '&id=' + id;
      datos += '&session=true';

      $.ajax({
        url: '{{ route("bienes.store") }}',
        type: 'post',
        dataType: 'json',
        data: datos,
        success: function (data) {
          /* Mensaje de exito */
          $('#titulo-modal-bien').html('Editar Bien');

          $('#modal-bien').modal('show');
          $('#form-bien').trigger('reset');
          $('#btn-agregar-bien').html('Modificar');

          $('#id_bien').val(data.id);
          $('#nom_bien').val(data.nom_bien);
          $('#dir_bien').val(data.dir_bien);
          $('#valor_bien').val(data.valor_bien);
          $('#tipo_bien').val(data.tipo_bien);
          $('#descripcion_bien').val(data.descripcion_bien);
        },
        error: function (xhr) {
          /* Mensajes de error */
        }
      });
    }

    function mostrarBienes(data){
      var html = "";

      $.each(data, function (key, value) {
        html += '<tr id="ref_' + key + '">';
        html += '<td>' + key + '</td>';
        html += '<td>' + value.nom_bien + '</td>';
        html += '<td>';
        html += "<div class='dropdown-icon-demo'> " +
          "<a href='javascript:void(0);' class='btn dropdown-toggle btn-sm hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'>" +
          "<i class='bx bx-dots-vertical-rounded'></i>" +
          "</a> " +
          "<div class='dropdown-menu'>" +
          "<a class='dropdown-item' href='javascript:void(0);' onclick='obtenerBien("+ value.id +")'>" +
          "<i class='bx bx-edit-alt me-1'></i>Editar" +
          "</a>" +
          "<div class='dropdown-divider'></div>" +
          "<a class='dropdown-item text-danger' href='javascript:void(0);' onclick='eliminarBien(" + value.id + ")'>" +
          "<i class='bx bx-trash me-1'></i> Borrar" +
          "</a>" +
          "</div>" +
          "</div>"
        html += '</td>';
        html += '</tr>';
      });

      if (data.length === 0){
        html += '<tr><td colspan="3">No hay resultados</td></tr>';
      }

      $('#tabla-bien').html(html);
    }
    /** FIN FUNCIONES DE BIEN **/


    /** FUNCIONES DE TELEFONO CLIENTE **/
    function eliminarTelefonoCliente(id) {
      var datos = $('#form-telscliente').serialize();
      datos += '&opcion=eliminar';
      datos += '&id=' + id;
      datos += '&session=true';

      $.ajax({
        url: '{{ route("telsCliente.store") }}',
        type: 'post',
        dataType: 'json',
        data: datos,
        success: function (data) {
          /* Mensaje de exito */
          $('#telefono-modal-cliente').modal('hide');
          $('#form-telscliente').trigger('reset');
          mostrarTelefonosCliente(data);
        },
        error: function (xhr) {
          /* Mensajes de error */
        }
      });
    }

    function mostrarTelefonosCliente(data){
      var html = "";

      $.each(data, function (key, value) {
        html += '<tr id="ref_' + key + '">';
        html += '<td>' + key + '</td>';
        html += '<td>' + value.tel_cliente + '</td>';
        html += "<td>" +
          "<button type='button' class='btn btn-outline-danger btn-sm' onclick='eliminarTelefonoCliente(" + key + ")'>" +
          "<i class='tf-icons bx bx-trash'></i>" +
          "</button>" +
          "</td>";
        html += '</tr>';
      });

      if (data.length === 0){
        html += '<tr><td colspan="3">No hay resultados</td></tr>';
      }

      $('#lista-telefonos-cliente').html(html);
    }
    /** FIN FUNCIONES DE TELEFONO CLIENTE **/

    /** FUNCIONES DE TELEFONO CONYUGE **/
    function eliminarTelefonoConyuge(id) {
      var datos = $('#form-telsconyuge').serialize();
      datos += '&opcion=eliminar';
      datos += '&id=' + id;
      datos += '&session=true';

      $.ajax({
        url: '{{ route("telsConyuge.store") }}',
        type: 'post',
        dataType: 'json',
        data: datos,
        success: function (data) {
          /* Mensaje de exito */
          $('#telefono-modal-conyuge').modal('hide');
          $('#form-telsconyuge').trigger('reset');
          mostrarTelefonosConyuge(data);
        },
        error: function (xhr) {
          /* Mensajes de error */
        }
      });
    }

    function mostrarTelefonosConyuge(data){
      var html = "";

      $.each(data, function (key, value) {
        html += '<tr id="ref_' + key + '">';
        html += '<td>' + key + '</td>';
        html += '<td>' + value.tel_conyuge + '</td>';
        html += "<td>" +
          "<button type='button' class='btn btn-outline-danger btn-sm' onclick='eliminarTelefonoConyuge(" + key + ")'>" +
          "<i class='tf-icons bx bx-trash'></i>" +
          "</button>" +
          "</td>";
        html += '</tr>';
      });

      if (data.length === 0){
        html += '<tr><td colspan="3">No hay resultados</td></tr>';
      }

      $('#lista-telefonos-conyuge').html(html);
    }
    /** FIN FUNCIONES DE TELEFONO CONYUGE **/

    /** FUNCIONES DE TELEFONO NEGOCIO **/
    function eliminarTelefonoNegocio(id) {
      var datos = $('#form-telsnegocio').serialize();
      datos += '&opcion=eliminar';
      datos += '&id=' + id;
      datos += '&session=true';

      $.ajax({
        url: '{{ route("telsNegocio.store") }}',
        type: 'post',
        dataType: 'json',
        data: datos,
        success: function (data) {
          /* Mensaje de exito */
          $('#form-telsnegocio').trigger('reset');
          mostrarTelefonosNegocio(data);
        },
        error: function (xhr) {
          /* Mensajes de error */
        }
      });
    }

    function mostrarTelefonosNegocio(data){
      var html = "";

      $.each(data, function (key, value) {
        html += '<tr id="ref_' + key + '">';
        html += '<td>' + key + '</td>';
        html += '<td>' + value.tel_negocio + '</td>';
        html += "<td>" +
          "<button type='button' class='btn btn-outline-danger btn-sm' onclick='eliminarTelefonoNegocio(" + key + ")'>" +
          "<i class='tf-icons bx bx-trash'></i>" +
          "</button>" +
          "</td>";
        html += '</tr>';
      });

      if (data.length === 0){
        html += '<tr><td colspan="3">No hay resultados</td></tr>';
      }

      $('#lista-telefonos-negocio').html(html);
    }
    /** FIN FUNCIONES DE TELEFONO NEGOCIO **/

    /** FUNCIONES DE TELEFONO REFERENCIA **/
    function eliminarTelefonoReferencia(id) {
      var datos = $('#form-telsreferencia').serialize();
      datos += '&opcion=eliminar';
      datos += '&id=' + id;
      datos += '&session=true';

      $.ajax({
        url: '{{ route("telsReferencia.store") }}',
        type: 'post',
        dataType: 'json',
        data: datos,
        success: function (data) {
          /* Mensaje de exito */
          $('#form-telsreferencia').trigger('reset');
          mostrarTelefonosReferencia(data);
        },
        error: function (xhr) {
          /* Mensajes de error */
        }
      });
    }

    function mostrarTelefonosReferencia(data){
      var html = "";

      $.each(data, function (key, value) {
        html += '<tr id="ref_' + key + '">';
        html += '<td>' + key + '</td>';
        html += '<td>' + value.tel_ref + '</td>';
        html += "<td>" +
          "<button type='button' class='btn btn-outline-danger btn-sm' onclick='eliminarTelefonoReferencia(" + key + ")'>" +
          "<i class='tf-icons bx bx-trash'></i>" +
          "</button>" +
          "</td>";
        html += '</tr>';
      });

      if (data.length === 0){
        html += '<tr><td colspan="3">No hay resultados</td></tr>';
      }

      $('#lista-telefonos-ref').html(html);
    }
    /** FIN FUNCIONES DE TELEFONO REFERENCIA **/

  </script>
@endsection
