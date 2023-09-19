@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Referencias')
@section('content')
  {{--  Header de botones --}}
  <div class="d-flex align-items-center justify-content-between py-3">
    <div class="flex-grow-1">
      <div
        class="d-flex align-items-center justify-content-md-between justify-content-start flex-md-row flex-column gap-4">
        <div class="user-profile-info">
          <h4 class="fw-bold m-0">
            <span class="text-muted fw-light">Clientes /</span> Referencias Personales
            <span
              class="text-muted fw-light fw">/ {{ $cliente->dui_cliente }} - {{ $cliente->primer_nom_cliente . ' ' . $cliente->primer_ape_cliente }}</span>

          </h4>
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
            <a class="nav-link btn btn-secondary" type="button" href="{{ route('clientes.index') }}">
              <i class="bx bx-arrow-back"></i> Volver
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  {{-- Navegacion entre panel --}}
  <ul class="nav nav-pills" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link" type="button" aria-selected="false" tabindex="-1"
         href="#">
        <i class="bx bx-user"></i> Cliente
      </a>
    </li>

    <li class="nav-item" role="presentation">
      <a class="nav-link {{ ($cliente->estado_civil_cliente != 'Casado') ? 'disabled' : '' }}" type="button"
         aria-selected="false" tabindex="-1"
         href="#">
        <i class="bx bx-user-check"></i> Conyuge
      </a>
    </li>

    <li class="nav-item" role="presentation">
      <a class="nav-link" type="button" aria-selected="false" tabindex="-1"
         href="{{ route('negocios.show', $cliente->id_cliente) }}">
        <i class="tf-icons bx bx-store-alt"></i> Negocio
      </a>
    </li>

    <li class="nav-item" role="presentation">
      <a class="nav-link active" type="button" aria-selected="false" tabindex="-1" data-bs-target="#card-referencia"
         href="{{ route('referencias.show', $cliente->id_cliente) }}">
        <i class="bx bx-user-plus"></i> Referencias
      </a>
    </li>

    <li class="nav-item" role="presentation">
      <a class="nav-link" type="button" aria-selected="false" tabindex="-1"
         href="{{ route('bienes.show', $cliente->id_cliente) }}">
        <i class="bx bx-building"></i> Bienes
      </a>
    </li>
  </ul>
  {{--  Fin --}}

  @if(Session::has('success'))
    <div class="alert alert-primary d-flex m-0 mt-3" role="alert">
          <span class="badge badge-center rounded-pill bg-primary border-label-primary p-3 me-2"><i
              class="bx bx-user fs-6"></i></span>
      <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Mensaje de éxito</h6>
        <span>{{ Session::get('mensaje') }}</span>
      </div>
    </div>
  @endif

  <div class="tab-pane show fade pt-3" id="card-referencia" role="tabpanel">
    <div class="row">
      <div class="col-md-12 mb-4">
        <!-- Referencias -->
        <div class="card p-3">
          <div class="card-datatable">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
              <div class="row my-3">
                <div class="col-md-6">
                  <label>
                    <input type="search"
                           class="form-control"
                           placeholder="Buscar..."
                           aria-controls="DataTables_Table_0">
                  </label>
                </div>
                <div
                  class="col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row ">
                  <div class="mb-3 mb-md-0">
                    <button type="button" class="btn btn-outline-primary" id="btn-nuevo-ref" data-bs-toggle="modal"
                            data-bs-target="#modal-ref"><i class="tf-icon bx bx-plus"></i>Nueva referencia
                    </button>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table border-top dtr-column my-3"
                       id="tabla-referencias"
                       aria-describedby="DataTables_Table_0_info">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Ocupación</th>
                    <th>Parentesco</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody id="tabla-ref">
                  @php($i = 1)
                  @foreach($referencias as $referencia)
                    <tr>
                      <td>{{ $i }}</td>
                      <td>{{ $referencia->primer_nom_ref . ' ' . $referencia->primer_ape_ref}}</td>
                      <td>{{ $referencia->dir_ref }}</td>
                      <td>{{ $referencia->ocupacion_ref }}</td>
                      <td>{{ $referencia->parentesco_ref }}</td>
                      <td>
                            <span
                              class="badge rounded-pill {{ ($referencia->estado_ref == 'Activo') ? 'bg-label-success' : 'bg-label-danger' }} ">
                              {{ $referencia->estado_ref }}
                            </span>
                      </td>
                      <td>
                        <div class="dropdown-icon-demo">
                          <a href="javascript:void(0);" class="btn dropdown-toggle btn-sm hide-arrow"
                             data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </a>
                          <div class="dropdown-menu">
                            @if($referencia->estado_ref == 'Activo')
                              <a class="dropdown-item" href="javascript:void(0);"
                                 onclick="verReferencia({{ $referencia->id_ref }})"><i class="bx bx-show me-1"></i>
                                Ver</a>
                              <a class="dropdown-item" href="javascript:void(0);"
                                 onclick="obtenerRef({{ $referencia->id_ref }})"><i
                                  class="bx bx-edit-alt me-1"></i>
                                Editar</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item text-danger" href="javascript:void(0);"
                                 onclick="eliminarRef({{ $referencia->id_ref }})"><i
                                  class="bx bx-trash me-1"></i> Dar de baja</a>

                            @else
                              <a class="dropdown-item" href="javascript:void(0);" onclick="darAltaRef({{ $referencia->id_ref }})">
                                <i class='bx bx-up-arrow-circle'></i> Dar de alta
                              </a>
                            @endif
                          </div>
                        </div>
                      </td>
                    </tr>
                    @php($i++)
                  @endforeach

                  @if(count($referencias) <= 0)
                    <tr>
                      <td colspan="7">No hay resultados</td>
                    </tr>
                  @endif
                  </tbody>
                </table>
              </div>

              <div class="row mx-2">
                <div class="col-sm-12 col-md-6">
                  <div class="dataTables_info" role="status" aria-live="polite">Showing 1 to
                    10 of 1 entries
                  </div>
                </div>
                <div class="col-sm-12 col-md-6">
                  <div class="dataTables_paginate paging_simple_numbers">
                    <ul class="pagination">
                      <li class="paginate_button page-item previous disabled"><a
                          aria-controls="DataTables_Table_0" aria-disabled="true" role="link" data-dt-idx="previous"
                          tabindex="0" class="page-link">Anterior</a></li>
                      <li class="paginate_button page-item active"><a href="#" aria-controls="DataTables_Table_0"
                                                                      role="link" aria-current="page" data-dt-idx="0"
                                                                      tabindex="0" class="page-link">1</a></li>

                      <li class="paginate_button page-item next" id="DataTables_Table_0_next"><a href="#"
                                                                                                 aria-controls="DataTables_Table_0"
                                                                                                 role="link"
                                                                                                 data-dt-idx="next"
                                                                                                 tabindex="0"
                                                                                                 class="page-link">Siguiente</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal agregar negocio -->
  <form action="{{ route('referencias.store') }}" method="post" autocomplete="off" enctype="multipart/form-data"
        id="form-ref">
    @csrf
    <div class="modal fade" data-bs-backdrop="static" id="modal-ref" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-lg modal-fullscreen-sm-down" role="document">
        <div class="modal-content">

          <div class="modal-header bg-primary">
            <h5 class="modal-title text-white text-center" id="titulo-modal-ref">Nueva referencia</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12 mb-3">
                <div class="pb-0">
                  <span class="fw-bold">Información general</span>
                  <hr class="my-2">
                </div>
                <div>
                  <input type="text" name="id_ref" id="id_ref" class="visually-hidden"/>

                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="primer_nom_ref" class="form-label">Primer nombre (*)</label>
                      <input type="text" name="primer_nom_ref" id="primer_nom_ref" class="form-control">
                      <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        <div data-field="name" data-validator="notEmpty" id="primer_nom_ref_error"></div>
                      </div>
                    </div>

                    <div class="col-md-6 mb-3">
                      <label for="segundo_nom_ref" class="form-label">Segundo nombre</label>
                      <input type="text" name="segundo_nom_ref" id="segundo_nom_ref" class="form-control">
                      <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        <div data-field="name" data-validator="notEmpty" id="segundo_nom_ref_error"></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="tercer_nom_ref" class="form-label">Tercer nombre</label>
                      <input type="text" name="tercer_nom_ref" id="tercer_nom_ref" class="form-control">
                      <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        <div data-field="name" data-validator="notEmpty" id="tercer_nom_ref_error"></div>
                      </div>
                    </div>

                    <div class="col-md-6 mb-3">
                      <label for="primer_ape_ref" class="form-label">Primer apellido (*)</label>
                      <input type="text" name="primer_ape_ref" id="primer_ape_ref" class="form-control">
                      <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        <div data-field="name" data-validator="notEmpty" id="primer_ape_ref_error"></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="segundo_ape_ref" class="form-label">Segundo apellido</label>
                      <input type="text" name="segundo_ape_ref" id="segundo_ape_ref" class="form-control">
                      <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        <div data-field="name" data-validator="notEmpty" id="segundo_ape_ref_error"></div>
                      </div>
                    </div>

                    <div class="col-md-6 mb-3">
                      <label for="ocupacion_ref" class="form-label">Ocupación (*)</label>
                      <input type="text" name="ocupacion_ref" id="ocupacion_ref" class="form-control">
                      <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        <div data-field="name" data-validator="notEmpty" id="ocupacion_ref_error"></div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label for="parentesco_ref" class="form-label">Parentesco (*)</label>
                      <input type="text" name="parentesco_ref" id="parentesco_ref" class="form-control">
                      <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        <div data-field="name" data-validator="notEmpty" id="parentesco_ref_error"></div>
                      </div>
                    </div>

                    <div class="col-md-6 mb-3">
                      <label class="form-label" for="dir_ref">Dirección (*)</label>
                      <textarea class="form-control" name="dir_ref" id="dir_ref" rows="2"></textarea>
                      <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        <div data-field="name" data-validator="notEmpty" id="dir_ref_error"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-12">
                <div class="pb-0">
                  <span class="fw-bold">Datos de contacto</span>
                  <hr class="my-2">
                </div>
                <div>
                  <div class="col-md-12">
                    <label class="form-label" for="tel_ref" id="label-telefono-ref">Teléfono (*)</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" id="tel_ref" name="tel_ref" placeholder="00000000"
                             maxlength="8" onkeypress="return soloNumeros(event)"/>
                      <button type="button" class="btn btn-outline-info" id="btn-agregar-telefono-referencias">
                        <span class="tf-icons bx bx-plus"></span> Agregar
                      </button>
                      <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        <div data-field="name" data-validator="notEmpty" id="tel_ref_error"></div>
                      </div>
                    </div>
                    <div class="alert alert-danger d-none" role="alert" id="alert_tel_ref">
                    </div>
                    <table class="table table-bordered border-top table-hover" id="tabla-telefonos-referencias">
                      <thead id="tabla-head-ref">
                      <tr>
                        <th>#</th>
                        <th>Teléfono</th>
                        <th></th>
                      </tr>
                      </thead>
                      <tbody id="lista-telefonos-ref">
                      <tr>
                        <td colspan="3">No hay resultados</td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btn-agregar-ref">
              <i class="bx bx-save"></i>
              Guardar
            </button>
            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal"
                    aria-label="Close">Cerrar
            </button>
          </div>

        </div>
      </div>
    </div>
  </form>

  <input type="text" name="id_cliente" id="id_cliente" value="{{ $cliente->id_cliente }}" class="visually-hidden"/>

@endsection

@section('page-script')
  <script src="{{ asset('assets/js/cliente.js') }}"></script>
  <script>
    $(document).ready(function () {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('#btn-nuevo-ref').click(function (e) {
        e.preventDefault();
        $('#modal-ref').modal('show');
        $('#titulo-modal-ref').html('Nueva referencia');
        $('#btn-agregar-ref').html('<i class="bx bx-save"></i> Guardar');
        $('#form-ref').trigger('reset');
        $('#tabla-telefonos-referencias').removeClass('border border-danger');
        $('#tel_ref').removeClass('is-invalid');

        resetFormularioReferencias();

        $('#id_ref').val('');
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

      $('#btn-agregar-ref').click(function (e) {
        e.preventDefault();

        var datos = $('#form-ref').serialize();
        let id_ref = $('#id_ref').val();
        const id_cliente = $('#id_cliente').val();

        if (id_ref !== '') {
          datos += '&opcion=actualizar';
          datos += '&id=' + id_ref;
        } else {
          datos += '&opcion=agregar';
          datos += '&id_cliente=' + id_cliente;
        }

        $.ajax({
          url: '{{ route("referencias.store") }}',
          type: 'post',
          dataType: 'json',
          data: datos,
          success: function (data) {
            /* Mensaje de exito */
            if (data.success === false) {
              $('#tabla-telefonos-referencias').addClass('border border-danger');
              $('#tel_ref').addClass('is-invalid');
              $('#tel_ref_error').html(data.message);
            } else {
              if (data.success != false) {
                location.reload();
              }
            }

          },
          error: function (xhr) {
            /* Mensajes de error */
            var inputs = $('#form-ref').find('input, select, textarea');

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

      $('#btn-agregar-telefono-referencias').click(function (e) {
        e.preventDefault();

        if ($('#tel_ref').val() === '') {
          $('#tel_ref').addClass('is-invalid');
          $('#tel_ref_error').html('El campo es obligatorio.');
        } else if ($('#tel_ref').val().length < 8) {
          $('#tel_ref').addClass('is-invalid');
          $('#tel_ref_error').html('El campo debe tener al menos 8 caracteres.');
        } else {
          let datos = 'tel_ref=' + $('#tel_ref').val();
          datos += '&opcion=agregar';

          if ($('#id_ref').val() !== '') {
            datos += '&id_ref=' + $('#id_ref').val();
          } else {
            datos += '&session=true';
          }


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
        }

      });
    });

    /** FUNCIONES DE REFERENCIA **/
     function obtenerRef(id) {

      var datos = 'opcion=obtener';
      datos += '&id_ref=' + id;

      $.ajax({
        url: '{{ route("referencias.store") }}',
        type: 'post',
        dataType: 'json',
        data: datos,
        success: function (data) {
          /* Mensaje de exito */
          console.log(data);
          $('#modal-ref').modal('show');
          $('#titulo-modal-ref').html('Editar referencia');
          $('#btn-agregar-ref').html('<i class="bx bx-edit-alt"></i> Modificar');

          $('#id_ref').val(data.ref.id_ref);
          $('#primer_nom_ref').val(data.ref.primer_nom_ref);
          $('#segundo_nom_ref').val(data.ref.segundo_nom_ref);
          $('#tercer_nom_ref').val(data.ref.tercer_nom_ref);
          $('#primer_ape_ref').val(data.ref.primer_ape_ref);
          $('#segundo_ape_ref').val(data.ref.segundo_ape_ref);
          $('#ocupacion_ref').val(data.ref.ocupacion_ref);
          $('#parentesco_ref').val(data.ref.parentesco_ref);
          $('#dir_ref').val(data.ref.dir_ref);

          mostrarTelefonosReferencia(data.tel_ref);
        },
        error: function (xhr) {
          /* Mensajes de error */
        }
      });
    }

    /** FIN FUNCIONES DE REFERENCIA **/

    /** FUNCIONES DE TELEFONO REFERENCIA **/
    function eliminarTelefonoReferencia(id) {
      let datos = 'id_tel_ref=' + id;
      datos += '&id_ref=' + $('#id_ref').val();

      if ($('#id_ref').val() === '') {
        datos += '&session=true';
      }
      datos += '&opcion=eliminar';

      $.ajax({
        url: '{{ route("telsReferencia.store") }}',
        type: 'post',
        dataType: 'json',
        data: datos,
        success: function (data) {
          /* Mensaje de exito */
          if (data.success === false) {
            $('#alert_tel_ref').removeClass('d-none').html(data.message);
          } else {
            mostrarTelefonosReferencia(data);
          }
        },
        error: function (xhr) {
          /* Mensajes de error */
        }
      });
    }

    function resetFormularioReferencias() {
      // Regresar Formulario al estado original
      $('#form-ref input').removeClass('d-none is-invalid').removeAttr('disabled');
      $('#form-ref label').removeClass('d-none');
      $('#form-ref textarea').removeClass('d-none is-invalid').removeAttr('disabled');
      $('#tabla-head-ref tr th:nth-child(3)').removeClass('d-none');
      $('#form-ref button').removeClass('d-none');
      $('#alert_tel_ref').addClass('d-none').html('');
    }

    function mostrarTelefonosReferencia(data) {
      var html = "";
      var i = 1;

      $.each(data, function (key, value) {
        html += '<tr id="ref_' + key + '">';
        html += '<td>' + i + '</td>';
        html += '<td>+503 ' + value.tel_ref + '</td>';
        html += "<td>" +
          "<button type='button' class='btn btn-outline-danger btn-sm' onclick='eliminarTelefonoReferencia(" + value.id_tel_ref + ")'>" +
          "<i class='tf-icons bx bx-trash'></i>" +
          "</button>" +
          "</td>";
        html += '</tr>';

        i++;
      });

      if (data.length === 0) {
        html += '<tr><td colspan="3">No hay resultados</td></tr>';
      }

      $('#tel_ref_error').html('');
      $('#tel_ref').removeClass('is-invalid');
      $('#tabla-telefonos-referencias').removeClass('border border-danger');
      $('#lista-telefonos-ref').html(html);
    }

    function verReferencia(id_cliente) {
      $.ajax({
        url: '{{ route("referencias.edit", ":id_cliente") }}'.replace(':id_cliente', id_cliente),
        type: 'get',
        dataType: 'json',
        success: function (data) {
          resetFormularioReferencias();

          /* Mensaje de exito */
          $('#titulo-modal-ref').html('Ver Referencia');

          $('#modal-ref').modal('show');
          $('#form-ref').trigger('reset');
          $('#btn-agregar-ref').addClass('d-none');

          $('#form-ref input').attr('disabled', 'disabled');
          $('#form-ref textarea').attr('disabled', 'disabled');
          $('#btn-agregar-telefono-referencias').addClass('d-none');
          $('#tel_ref').addClass('d-none');
          $('#label-telefono-ref').addClass('d-none');

          mostrarReferencia(data);
          mostrarTelefonosReferencia(data.tel_ref);

          // Eliminar tercera columna de la tabla
          $('#lista-telefonos-ref tr td:nth-child(3)').addClass('d-none');
          $('#tabla-head-ref tr th:nth-child(3)').addClass('d-none');

        },
        error: function (xhr) {
          /* Mensajes de error */
        }
      });
    }

    function mostrarReferencia(data) {
      $('#primer_nom_ref').val(data.ref.primer_nom_ref);
      $('#segundo_nom_ref').val(data.ref.segundo_nom_ref);
      $('#tercer_nom_ref').val(data.ref.tercer_nom_ref);
      $('#primer_ape_ref').val(data.ref.primer_ape_ref);
      $('#segundo_ape_ref').val(data.ref.segundo_ape_ref);
      $('#ocupacion_ref').val(data.ref.ocupacion_ref);
      $('#parentesco_ref').val(data.ref.parentesco_ref);
      $('#dir_ref').val(data.ref.dir_ref);
    }

    function eliminarRef(id) {
      let datos = 'id_ref=' + id;
      datos += '&opcion=eliminar';

      $.ajax({
        url: '{{ route("referencias.store") }}',
        type: 'post',
        dataType: 'json',
        data: datos,
        success: function (data) {
          // Recargar pagina
          location.reload();
        },
        error: function (xhr) {
          /* Mensajes de error */
        }
      });
    }

    function darAltaRef(id){
      let datos = 'id_ref=' + id;
      datos += '&opcion=darAlta';

      $.ajax({
        url: '{{ route("referencias.store") }}',
        type: 'post',
        dataType: 'json',
        data: datos,
        success: function (data) {
          // Recargar pagina
          location.reload();
        },
        error: function (xhr) {
          /* Mensajes de error */
        }
      });
    }

    /** FIN FUNCIONES DE TELEFONO REFERENCIA **/

  </script>

@endsection
