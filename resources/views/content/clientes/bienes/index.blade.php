@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Bienes')

@section('content')



  {{--  Header de botones --}}
  <div class="d-flex align-items-center justify-content-between py-3">
    <div class="flex-grow-1">
      <div
        class="d-flex align-items-center justify-content-md-between justify-content-start flex-md-row flex-column gap-4">
        <div class="user-profile-info">
          <h4 class="fw-bold m-0">
            <span class="text-muted fw-light">Clientes /</span> Bienes muebles
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
  {{--  Fin --}}

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
      <a class="nav-link" type="button" aria-selected="false" tabindex="-1"
         href="{{ route('referencias.show', $cliente->id_cliente) }}">
        <i class="bx bx-user-plus"></i> Referencias
      </a>
    </li>

    <li class="nav-item" role="presentation">
      <a class="nav-link active" type="button" aria-selected="false" tabindex="-1"
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

  <div class="tab-pane show fade pt-3" id="card-bienes" role="tabpanel">
    <div class="row">
      <div class="col-md-12 mb-4">
        <!-- Bienes -->
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
                    <button type="button" class="btn btn-outline-primary" id="btn-nuevo-bien" data-bs-toggle="modal"
                            data-bs-target="#modal-bien"><i class="tf-icon bx bx-plus"></i>Nuevo bien
                    </button>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table border-top dtr-column my-3">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody id="tabla-bien">
                  @php($i = 1)
                  @foreach($bienes as $bien)
                    <tr>
                      <td>{{ $i }}</td>
                      <td>{{ $bien->nom_bien }}</td>
                      <td>
                        <span
                          class="badge rounded-pill {{ ($bien->estado_bien == 'Activo') ? 'bg-label-success' : 'bg-label-danger' }} ">
                          {{ $bien->estado_bien }}
                        </span>
                      </td>
                      <td>
                        <div class="dropdown-icon-demo">
                          <a href="javascript:void(0);" class="btn dropdown-toggle btn-sm hide-arrow"
                             data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </a>
                          <div class="dropdown-menu">
                            @if($bien->estado_bien == 'Activo')
                              <a class="dropdown-item" href="javascript:void(0);"
                                 onclick="verBien({{ $bien->id_bien }})"><i class="bx bx-show me-1"></i>
                                Ver</a>
                              <a class="dropdown-item" href="javascript:void(0);"
                                 onclick="obtenerBien({{ $bien->id_bien }})"><i
                                  class="bx bx-edit-alt me-1"></i>
                                Editar</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item text-danger" href="javascript:void(0);"
                                 onclick="eliminarBien({{ $bien->id_bien }})"><i
                                  class="bx bx-trash me-1"></i> Dar de baja</a>

                            @else
                              <a class="dropdown-item" href="javascript:void(0);"
                                 onclick="darAltaBien({{ $bien->id_bien }})">
                                <i class='bx bx-up-arrow-circle' ></i> Dar de alta
                              </a>
                            @endif
                          </div>
                        </div>
                      </td>
                    </tr>
                    @php($i++)
                  @endforeach
                  @if(count($bienes) <= 0)
                    <tr>
                      <td colspan="4">No hay resultados</td>
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

  <!-- Modal agregar bien -->
  <form action="{{ route('bienes.store') }}" method="post" autocomplete="off" enctype="multipart/form-data"
        id="form-bien">

    <div class="modal fade" data-bs-backdrop="static" id="modal-bien" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-sm" role="document">
        <div class="modal-content">

          <div class="modal-header bg-primary">
            <h5 class="modal-title text-white text-center" id="titulo-modal-bien">Nuevo bien</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body pb-0">
            <div class="row">
              <div class="col-lg-12 mb-3">
                <input type="text" name="id_bien" id="id_bien" class="visually-hidden"/>
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <label for="nom_bien" class="form-label">Nombre (*)</label>
                    <textarea name="nom_bien" id="nom_bien" class="form-control" rows="3"
                              placeholder="Descripción"></textarea>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                      <div data-field="name" data-validator="notEmpty" id="nom_bien_error"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btn-agregar-bien">
              Agregar
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
  <script>
    $(document).ready(function () {

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('#btn-nuevo-bien').click(function (e) {
        e.preventDefault();
        $('#titulo-modal-bien').html('Nuevo Bien');
        $('#form-bien').trigger('reset');
        $('#nom_bien').removeClass('is-invalid');
        $('#btn-agregar-bien').html('<i class="bx bx-save"></i> Guardar');
      });

      $('#btn-agregar-bien').click(function (e) {
        e.preventDefault();

        if ($('#nom_bien').val() === '') {
          $('#nom_bien').addClass('is-invalid');
          $('#nom_bien_error').html('El campo es obligatorio.');
        } else {

          var datos = $('#form-bien').serialize();
          let id_bien = $('#id_bien').val();

          if (id_bien !== '') {
            datos += '&opcion=actualizar';
            datos += '&id_bien=' + id_bien;

          } else {
            datos += '&id_cliente=' + $('#id_cliente').val();
            datos += '&opcion=agregar';
          }

          $.ajax({
            url: '{{ route("bienes.store") }}',
            type: 'post',
            dataType: 'json',
            data: datos,
            success: function (data) {
              /* Mensaje de exito */
              if(data.success === false){
                $('#nom_bien').addClass('is-invalid');
                $('#nom_bien_error').html(data.message);

                $('#nom_bien').change(function () {
                  $(this).removeClass('is-invalid'); //Eliminar clase 'is-invalid'
                });
              }else{
                location.reload();
              }

            },
            error: function (xhr) {
              /* Mensajes de error */
            }
          });
        }

      });

    });

    function eliminarBien(id) {
      var datos = $('#form-bien').serialize();
      datos += '&opcion=eliminar';
      datos += '&id=' + id;

      $.ajax({
        url: '{{ route("bienes.store") }}',
        type: 'post',
        dataType: 'json',
        data: datos,
        success: function (data) {
          /* Mensaje de exito */
          location.reload();
        },
        error: function (xhr) {
          /* Mensajes de error */
        }
      });
    }

    function obtenerBien(id) {
      var datos = $('#form-bien').serialize();
      datos += '&opcion=obtener';
      datos += '&id_bien=' + id;

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
          $('#btn-agregar-bien').html('<i class="bx bx-edit-alt me-1"></i>Modificar');

          $('#id_bien').val(data.id_bien);
          $('#nom_bien').val(data.nom_bien);
        },
        error: function (xhr) {
          /* Mensajes de error */
        }
      });
    }

    function darAltaBien(id){
      let datos = 'id_bien=' + id;
      datos += '&opcion=darAlta';

      $.ajax({
        url: '{{ route("bienes.store") }}',
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
