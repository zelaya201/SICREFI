@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Negocios')
@section('content')

  @include('content.clientes._partials.header', ['title' => 'Negocios'])
  @include('content.clientes._partials.info')
  @include('content.clientes._partials.nav')

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

  @if(Session::has('error'))
    <div class="alert alert-danger d-flex m-0 mt-3" role="alert">
          <span class="badge badge-center rounded-pill bg-danger border-label-danger p-3 me-2"><i
              class="bx bx-user fs-6"></i></span>
      <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Acción no permitida</h6>
        <span>{{ Session::get('mensaje') }}</span>
      </div>
    </div>
  @endif

  {{-- Contenido de los paneles --}}
  <div class="tab-content p-0">
    <div class="tab-pane fade show active pt-3" id="card-datos-negocios" role="tabpanel">
      <div class="row">
        <div class="col-md-12 mb-4">
          <!-- Negocios -->
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
                      <button type="button" class="btn btn-outline-primary" id="btn-nuevo-negocio"
                              data-bs-toggle="modal"
                              data-bs-target="#modal-negocio"><i class="tf-icon bx bx-plus"></i>Nuevo negocio
                      </button>
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table border-top dtr-column my-3"
                         id="DataTables_Table_0"
                         aria-describedby="DataTables_Table_0_info">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Dirección</th>
                      <th>Tiempo de operación</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody id="tabla-negocios">
                    @php($i = 1)
                    @foreach($negocios as $negocio)
                      <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $negocio->nom_negocio }}</td>
                        <td>{{ $negocio->dir_negocio }}</td>
                        <td>{{ number_format($negocio->tiempo_negocio / 12, 0) . ' año(s) ' }}</td>
                        <td><span
                            class="badge rounded-pill {{ ($negocio->estado_negocio == 'Activo') ? 'bg-label-success' : 'bg-label-danger' }} ">{{ $negocio->estado_negocio }}</span>
                        </td>
                        <td>

                          <div class="dropdown-icon-demo">
                            <a href="javascript:void(0);" class="btn dropdown-toggle btn-sm hide-arrow"
                               data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </a>
                            <div class="dropdown-menu">
                              @if($negocio->estado_negocio == 'Activo')
                                <a class="dropdown-item" href="javascript:void(0);"
                                   onclick="verNegocio({{ $negocio->id_negocio }})"><i class="bx bx-show me-1"></i>
                                  Ver</a>
                                <a class="dropdown-item" href="javascript:void(0);"
                                   onclick="obtenerNegocio({{ $negocio->id_negocio }})"><i
                                    class="bx bx-edit-alt me-1"></i>
                                  Editar</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="javascript:void(0);"
                                   onclick="eliminarNegocio({{ $negocio->id_negocio }})"><i
                                    class="bx bx-trash me-1"></i> Dar de baja</a>

                              @else
                                <a class="dropdown-item" href="javascript:void(0);"
                                   onclick="darAltaNegocio({{ $negocio->id_negocio }})">
                                  <i class='bx bx-up-arrow-circle'></i> Dar de alta
                                </a>
                              @endif
                            </div>
                          </div>
                        </td>
                      </tr>
                      @php($i++)
                    @endforeach

                    @if(count($negocios) <= 0)
                      <tr>
                        <td colspan="6">No hay resultados</td>
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

    @include('.content.clientes._partials.dar_alta_cliente')

    <!-- Modal agregar negocio -->
    <form action="{{ route('negocios.store') }}" method="post" autocomplete="off" enctype="multipart/form-data"
          id="form-negocio">

      <div class="modal fade" data-bs-backdrop="static" id="modal-negocio" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg modal-fullscreen-sm-down" role="document">
          <div class="modal-content">

            <div class="modal-header bg-primary">
              <h5 class="modal-title text-white text-center" id="titulo-modal-negocio">Nuevo negocio</h5>
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
                    <input type="text" name="id_negocio" id="id_negocio" class="visually-hidden"/>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label for="nom_negocio" class="form-label">Nombre (*)</label>
                        <input type="text" name="nom_negocio" id="nom_negocio" class="form-control">
                        <div
                          class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                          <div data-field="name" data-validator="notEmpty" id="nom_negocio_error"></div>
                        </div>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="tiempo_negocio" class="form-label">Tiempo de operación (*)</label>
                        <input type="text" name="tiempo_negocio" id="tiempo_negocio" class="form-control"
                               placeholder="Cantidad en meses" onkeypress="return soloNumeros(event)">
                        <div
                          class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                          <div data-field="name" data-validator="notEmpty" id="tiempo_negocio_error"></div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12 mb-3">
                        <label class="form-label" for="dir_negocio">Dirección (*)</label>
                        <textarea class="form-control" name="dir_negocio" id="dir_negocio" rows="2"></textarea>
                        <div
                          class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                          <div data-field="name" data-validator="notEmpty" id="dir_negocio_error"></div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label for="buena_venta_negocio" class="form-label">Venta en dia bueno (*)</label>
                        <input type="text" name="buena_venta_negocio" id="buena_venta_negocio" class="form-control"
                               placeholder="0.00" onkeypress="return filterFloat(event,this);">
                        <div
                          class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                          <div data-field="name" data-validator="notEmpty" id="buena_venta_negocio_error"></div>
                        </div>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="mala_venta_negocio" class="form-label">Venta en dia malo (*)</label>
                        <input type="text" name="mala_venta_negocio" id="mala_venta_negocio" class="form-control"
                               placeholder="0.00" onkeypress="return filterFloat(event,this);">
                        <div
                          class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                          <div data-field="name" data-validator="notEmpty" id="mala_venta_negocio_error"></div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label for="ganancia_diaria_negocio" class="form-label">Ganancia diaria (*)</label>
                        <input type="text" name="ganancia_diaria_negocio" id="ganancia_diaria_negocio"
                               class="form-control"
                               placeholder="0.00" onkeypress="return filterFloat(event,this);">
                        <div
                          class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                          <div data-field="name" data-validator="notEmpty" id="ganancia_diaria_negocio_error"></div>
                        </div>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="inversion_diaria_negocio" class="form-label">Inversión diaria (*)</label>
                        <input type="text" name="inversion_diaria_negocio" id="inversion_diaria_negocio"
                               class="form-control" placeholder="0.00" onkeypress="return filterFloat(event,this);">
                        <div
                          class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                          <div data-field="name" data-validator="notEmpty" id="inversion_diaria_negocio_error"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-12 mb-3">
                  <div class="pb-0">
                    <span class="fw-bold">Gastos</span>
                    <hr class="my-2">
                  </div>
                  <div>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label for="gasto_emp_negocio" class="form-label">Pago de empleados (*)</label>
                        <input type="text" name="gasto_emp_negocio" id="gasto_emp_negocio" class="form-control"
                               placeholder="0.00" onkeypress="return filterFloat(event,this);">
                        <div
                          class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                          <div data-field="name" data-validator="notEmpty" id="gasto_emp_negocio_error"></div>
                        </div>
                      </div>

                      <div class="col-md-6 mb-3">
                        <label for="gasto_alquiler_negocio" class="form-label">Alquiler de local (*)</label>
                        <input type="text" name="gasto_alquiler_negocio" id="gasto_alquiler_negocio"
                               class="form-control"
                               placeholder="0.00" onkeypress="return filterFloat(event,this);">
                        <div
                          class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                          <div data-field="name" data-validator="notEmpty" id="gasto_alquiler_negocio_error"></div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-4 mb-3">
                        <label for="gasto_impuesto_negocio" class="form-label">Impuestos (*)</label>
                        <input type="text" name="gasto_impuesto_negocio" id="gasto_impuesto_negocio"
                               class="form-control"
                               placeholder="0.00" onkeypress="return filterFloat(event,this);">
                        <div
                          class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                          <div data-field="name" data-validator="notEmpty" id="gasto_impuesto_negocio_error"></div>
                        </div>
                      </div>

                      <div class="col-md-4 mb-3">
                        <label for="gasto_credito_negocio" class="form-label">Cuotas de créditos (*)</label>
                        <input type="text" name="gasto_credito_negocio" id="gasto_credito_negocio" class="form-control"
                               placeholder="0.00" onkeypress="return filterFloat(event,this);">
                        <div
                          class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                          <div data-field="name" data-validator="notEmpty" id="gasto_credito_negocio_error"></div>
                        </div>
                      </div>

                      <div class="col-md-4 mb-3">
                        <label for="gasto_otro_negocio" class="form-label">Otros pagos (*)</label>
                        <input type="text" name="gasto_otro_negocio" id="gasto_otro_negocio" class="form-control"
                               placeholder="0.00" onkeypress="return filterFloat(event,this);">
                        <div
                          class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                          <div data-field="name" data-validator="notEmpty" id="gasto_otro_negocio_error"></div>
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
                      <label class="form-label" for="tel_negocio" id="label-telefono-negocio">Teléfono (*)</label>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" id="tel_negocio" name="tel_negocio"
                               placeholder="00000000"
                               maxlength="8" onkeypress="return soloNumeros(event)"/>
                        <button type="button" class="btn btn-outline-info" id="btn-agregar-telefono-negocio">
                          <span class="tf-icons bx bx-plus"></span> Agregar
                        </button>
                        <div
                          class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                          <div data-field="name" data-validator="notEmpty" id="tel_negocio_error"></div>
                        </div>
                      </div>

                      <div class="alert alert-danger d-none" role="alert" id="alert_tel_negocio">
                      </div>

                      <table class="table table-bordered border-top table-hover" id="tabla-telefonos-negocio">
                        <thead id="tabla-head-negocio">
                        <tr>
                          <th>#</th>
                          <th>Teléfono</th>
                          <th></th>
                        </tr>
                        </thead>
                        <tbody id="lista-telefonos-negocio">
                        <tr>
                          <td colspan="3">No hay resultados</td>
                        </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 mb-3 text-end">
                  Los campos marcados con <span class="text-danger">(*)</span> son obligatorios
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-primary" id="btn-agregar-negocio">
                <i class="bx bx-save"></i> Guardar
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

  </div>

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

      /** EVENTOS DE NEGOCIO **/
      $('#btn-nuevo-negocio').click(function () {
        $('#titulo-modal-negocio').html('<i class="bx bx-show"></i> Nuevo negocio');
        $('#btn-agregar-negocio').html('<i class="bx bx-save"></i> Guardar');
        $('#form-negocio').trigger('reset');
        $('#tabla-telefonos-negocio').removeClass('border border-danger');
        $('#tel_negocio').removeClass('is-invalid');

        resetFormularioNegocio();

        $('#id_negocio').val('');
        $('#lista-telefonos-negocio').html('<tr><td colspan="3">No hay resultados</td></tr>');
      });

      $('#btn-agregar-negocio').click(function () {

        let data = $('#form-negocio').serialize();
        let id_cliente = $('#id_cliente').val();
        data += '&id_cliente=' + id_cliente;

        if ($('#id_negocio').val() !== '') {
          data += '&id_negocio=' + $('#id_negocio').val();
          data += '&opcion=actualizar';
        } else {
          data += '&opcion=agregar';
        }

        $.ajax({
          url: "{{ route('negocios.store') }}",
          method: "POST",
          data: data,
          dataType: "json",
          success: function (data) {
            if (data.success === false) {

              if (data.input === 'nom_negocio') {
                $('#nom_negocio').addClass('is-invalid');
                $('#nom_negocio_error').html(data.message);
              } else {
                $('#tabla-telefonos-negocio').addClass('border border-danger');
                $('#tel_negocio').addClass('is-invalid');
                $('#tel_negocio_error').html(data.message);
              }
            } else {
              location.reload();
            }
          },
          error: function (xhr) {
            var inputs = $('#form-negocio').find('input, select, textarea');

            inputs.change(function () {
              $(this).removeClass('is-invalid'); //Eliminar clase 'is-invalid'
            });

            let res = xhr.responseJSON;
            if ($.isEmptyObject(res) === false) {
              $.each(res.errors, function (key, value) {
                $('#' + key + '_error').html(value[0]);
                $('#' + key).addClass('is-invalid');
              });
            }
          }
        })
      });

      $('#btn-nuevo-negocio').click(function (e) {
        e.preventDefault();
        $('#titulo-modal-negocio').html('Nuevo Negocio');
        $('#form-negocio').trigger('reset');
        $('#btn-agregar-negocio').html('<i class="bx bx-save"></i> Guardar');
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
      /** FIN EVENTOS DE NEGOCIO **/

      /** EVENTOS DE BOTONES TELEFONO NEGOCIO **/
      $('#btn-agregar-telefono-negocio').click(function (e) {
        e.preventDefault();

        if ($('#tel_negocio').val() === '') {
          $('#tel_negocio').addClass('is-invalid');
          $('#tel_negocio_error').html('El campo teléfono es obligatorio');
          return false;
        } else if ($('#tel_negocio').val().length < 8 || $('#tel_negocio').val().length > 8 || isNaN($('#tel_negocio').val())) {
          $('#tel_negocio').addClass('is-invalid');
          $('#tel_negocio_error').html('El campo teléfono debe tener 8 dígitos');
          return false;
        } else {
          let datos = 'tel_negocio=' + $('#tel_negocio').val();
          datos += '&id_negocio=' + $('#id_negocio').val();

          if ($('#id_negocio').val() === '') {
            datos += '&session=true';
          }

          datos += '&opcion=agregar';

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
              var inputs = $('#form-negocio').find('input, select, textarea');

              inputs.change(function () {
                $(this).removeClass('is-invalid'); //Eliminar clase 'is-invalid'
              });

              let res = xhr.responseJSON;
              if ($.isEmptyObject(res) === false) {
                $.each(res.errors, function (key, value) {
                  $('#' + key + '_error').html(value[0]);
                  $('#' + key).addClass('is-invalid');
                });
              }
            }
          });

          $('#tel_negocio').change(function () {
            $('#tabla-telefonos-negocio').removeClass('border border-danger');
            $('#tel_negocio').removeClass('is-invalid');
            $('#tel_negocio_error').html('');
          });
        }


      });
      /** FIN EVENTOS DE BOTONES TELEFONO NEGOCIO **/

    });

    function resetFormularioNegocio() {
      // Regresar Formulario al estado original
      $('#form-negocio input').removeClass('d-none is-invalid').removeAttr('disabled');
      $('#form-negocio label').removeClass('d-none');
      $('#form-negocio textarea').removeClass('d-none is-invalid').removeAttr('disabled');
      $('#tabla-head-negocio tr th:nth-child(3)').removeClass('d-none');
      $('#form-negocio button').removeClass('d-none');
      $('#alert_tel_negocio').addClass('d-none').html('');
    }

    function obtenerNegocio(id_cliente) {
      $.ajax({
        url: '{{ route("negocios.edit", ":id_cliente") }}'.replace(':id_cliente', id_cliente),
        type: 'get',
        dataType: 'json',
        success: function (data) {
          /* Mensaje de exito */
          $('#titulo-modal-negocio').html('Editar Negocio');

          $('#modal-negocio').modal('show');
          $('#form-negocio').trigger('reset');
          $('#btn-agregar-negocio').html('<i class="bx bx-edit-alt"></i>Modificar');

          mostrarNegocio(data);

          mostrarTelefonosNegocio(data.tel_negocio);
          resetFormularioNegocio();
        },
        error: function (xhr) {
          /* Mensajes de error */
        }
      });
    }

    function mostrarNegocio(data) {
      $('#id_negocio').val(data.negocio.id_negocio);
      $('#nom_negocio').val(data.negocio.nom_negocio);
      $('#dir_negocio').val(data.negocio.dir_negocio);
      $('#tiempo_negocio').val(data.negocio.tiempo_negocio);
      $('#buena_venta_negocio').val(data.negocio.buena_venta_negocio.toFixed(2));
      $('#mala_venta_negocio').val(data.negocio.mala_venta_negocio.toFixed(2));
      $('#ganancia_diaria_negocio').val(data.negocio.ganancia_diaria_negocio.toFixed(2));
      $('#inversion_diaria_negocio').val(data.negocio.inversion_diaria_negocio.toFixed(2));
      $('#gasto_emp_negocio').val(data.negocio.gasto_emp_negocio.toFixed(2));
      $('#gasto_alquiler_negocio').val(data.negocio.gasto_alquiler_negocio.toFixed(2));
      $('#gasto_impuesto_negocio').val(data.negocio.gasto_impuesto_negocio.toFixed(2));
      $('#gasto_credito_negocio').val(data.negocio.gasto_credito_negocio.toFixed(2));
      $('#gasto_otro_negocio').val(data.negocio.gasto_otro_negocio.toFixed(2));
    }

    function verNegocio(id_cliente) {

      $.ajax({
        url: '{{ route("negocios.edit", ":id_cliente") }}'.replace(':id_cliente', id_cliente),
        type: 'get',
        dataType: 'json',
        success: function (data) {
          resetFormularioNegocio();

          /* Mensaje de exito */
          $('#titulo-modal-negocio').html('Ver Negocio');

          $('#modal-negocio').modal('show');
          $('#form-negocio').trigger('reset');
          $('#btn-agregar-negocio').addClass('d-none');

          $('#form-negocio input').attr('disabled', 'disabled');
          $('#form-negocio textarea').attr('disabled', 'disabled');
          $('#btn-agregar-telefono-negocio').addClass('d-none');
          $('#tel_negocio').addClass('d-none');
          $('#label-telefono-negocio').addClass('d-none');

          mostrarNegocio(data);
          mostrarTelefonosNegocio(data.tel_negocio);

          // Eliminar tercera columna de la tabla
          $('#lista-telefonos-negocio tr td:nth-child(3)').addClass('d-none');
          $('#tabla-head-negocio tr th:nth-child(3)').addClass('d-none');

          mostrarNegocio(data);

        },
        error: function (xhr) {
          /* Mensajes de error */
        }
      });
    }

    function mostrarTelefonosNegocio(data) {
      var html = "";

      let i = 1;

      $.each(data, function (key, value) {
        html += '<tr id="ref_' + key + '">';
        html += '<td>' + i + '</td>';
        html += '<td>+503 ' + value.tel_negocio + '</td>';
        html += "<td>" +
          "<button type='button' class='btn btn-outline-danger btn-sm' onclick='eliminarTelefonoNegocio(" + value.id_tel_negocio + ")'>" +
          "<i class='tf-icons bx bx-trash'></i>" +
          "</button>" +
          "</td>";

        html += '</tr>';

        i++;
      });

      if (data.length === 0) {
        html += '<tr><td colspan="3">No hay resultados</td></tr>';
      }

      $('#lista-telefonos-negocio').html(html);
    }

    function eliminarTelefonoNegocio(id) {
      let datos = 'id_tel_negocio=' + id;
      datos += '&id_negocio=' + $('#id_negocio').val();
      if ($('#id_negocio').val() === '') {
        datos += '&session=true';
      }
      datos += '&opcion=eliminar';

      $.ajax({
        url: '{{ route("telsNegocio.store") }}',
        type: 'post',
        dataType: 'json',
        data: datos,
        success: function (data) {
          /* Mensaje de exito */
          if (data.success === false) {
            $('#alert_tel_negocio').removeClass('d-none').html(data.message);
          } else {
            mostrarTelefonosNegocio(data);
          }

        },
        error: function (xhr) {
          /* Mensajes de error */

        }
      });
    }

    function eliminarNegocio(id) {
      let datos = 'id_negocio=' + id;
      datos += '&opcion=eliminar';

      $.ajax({
        url: '{{ route("negocios.store") }}',
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

    function darAltaNegocio(id) {
      let datos = 'id_negocio=' + id;
      datos += '&opcion=darAlta';

      $.ajax({
        url: '{{ route("negocios.store") }}',
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

  </script>

@endsection

