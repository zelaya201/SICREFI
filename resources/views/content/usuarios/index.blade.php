@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Usuarios')
@section('content')
  <div class=" flex-grow-1 py-3">
    <div
      class="d-flex align-items-center justify-content-md-between justify-content-start flex-md-row flex-column mb-4">
      <div class="user-profile-info py-1">
        <h4 class="fw-bold m-0"><span class="text-muted fw-light">Usuarios /</span> Listado de usuarios</h4>
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
          <a class="nav-link btn btn-primary load" type="button" href="{{ route('usuarios.create') }}"><span
              class="tf-icons bx bx-plus"></span> <span class="d-none d-sm-inline-block"> Nuevo usuario</span> </a>
        </li>
      </ul>
    </div>

    @if(Session::has('success'))
      <div class="alert alert-primary d-flex" role="alert">
          <span class="badge badge-center rounded-pill bg-primary border-label-primary p-3 me-2"><i
              class="bx bx-user fs-6"></i></span>
        <div class="d-flex flex-column ps-1">
          <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Mensaje de éxito</h6>
          <span>{{ Session::get('mensaje') }}</span>
        </div>
      </div>
    @endif

    <form id="filter_index" action="{{ route('usuarios.index') }}" method="get">
      <div class="card p-3">
        <div class="card-datatable">
          <div class="dataTables_wrapper dt-bootstrap5 no-footer">
            <div class="row my-3">
              <div class="col-md-6">
                <div class="col-md-6">
                  <label>
                    <input type="search" class="form-control"  id="search_bar" placeholder="Buscar por usuario...">
                  </label>
                </div>
              </div>

              <div class="col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-3">
                <div class="invoice_status mb-3 mb-md-0">
                  <select id="estado" name="estado" class="form-select">
                    <option value="Vigente" {{ session('estado_filtro') === 'Activos' ? 'selected' : '' }} class="text-capitalize">Activos</option>
                    <option value="En mora" {{ session('estado_filtro') === 'Inactivos' ? 'selected' : '' }} class="text-capitalize">Inactivos</option>
                    <option value="Todos" {{ session('estado_filtro') === 'Todos' ? 'selected' : '' }}>Todos</option>
                  </select>
                </div>
                <div class="dataTables_length" ><label>
                    <select id="mostrar" name="mostrar" class="form-select">
                      <option value="">Mostrar</option>
                      <option value="10" {{ session('mostrar') == 10 ? 'selected' : '' }}>10</option>
                      <option value="25" {{ session('mostrar') == 25 ? 'selected' : '' }}>25</option>
                      <option value="50" {{ session('mostrar') == 50 ? 'selected' : '' }}>50</option>
                    </select></label></div>
              </div>
            </div>

            <div id="table_div">
              <table id="usuarios_table" class="table-responsive invoice-list-table table border-top dataTable no-footer dtr-column my-2">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Usuario</th>
                  <th>Correo electrónico</th>
                  <th>Rol</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody id="clientes_tbody" class="alldata">
                @php
                  $registrosPerPage = 10;
                  $contador = 1;
                  //$contador = 1;
                @endphp
                @if($usuarios->isEmpty())
                  <tr>
                    <td colspan="8" class="text-center">No hay registros</td>
                  </tr>
                @else
                  @foreach($usuarios as $usuario)
                    <tr style="text-align: center;">
                      <td>{{ $contador }}</td>
                      <td>{{ $usuario->nom_usuario }}</td>

                      <td>{{ $usuario->nick_usuario }}</td>
                      <td>{{ $usuario->email_usuario }}</td>
                      <td>{{ $usuario->rol->nom_rol }}</td>

                      <!--Filtro para Estado-->
                      @if($usuario->estado_usuario == 'Activo')
                        <td><span class="badge rounded-pill bg-label-success">Activo</span></td>
                      @elseif($usuario->estado_usuario == 'Inactivo')
                        <td><span class="badge rounded-pill bg-label-danger">Inactivo</span></td>
                      @endif

                      <td>
                        <div class="dropdown-icon-demo">
                          <a href="javascript:void(0);" class="btn dropdown-toggle btn-sm hide-arrow"
                             data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </a>
                          <div class="dropdown-menu">
                              <a class="dropdown-item" href="javascript:void(0);"><i
                                  class="bx bx-detail me-1"></i> editar</a>
                          </div>

                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void(0);"><i
                                class="bx bx-detail me-1"></i> editar</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                    @php $contador++; @endphp
                  @endforeach
                @endif
                </tbody>

                <tbody id="searchdata" class="searchdata"></tbody>
              </table>

              <div class="row">
                <div class="col-sm-12 col-md-6"></div>
                <div class="col-sm-12 col-md-6 d-flex justify-content-end">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>

    <!-- Modal reactivar -->
    <div class="modal fade" id="modal_usuario" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" style="width: 550px;">
        <div class="modal-content">
          <div class="modal-body mt-2">
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-1">
                    <h1 id="icono">

                    </h1>
                  </div>
                  <div class="col-md-10 ms-4 mt-2">
                    <h4><b><span id="titulo"></span></b></h4>
                    <h6 class="text-secondary fw-normal mt-3" id="descripcion"></h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button id="btn_accion" type="button" class="btn btn-info">Dar de alta</button>
          </div>
        </div>
      </div>
    </div>
    @endsection

    @section('page-script')
      <script>
        $(document).ready(function () {
          /* Filtro de busqueda */
          $('#search_bar').keyup(function () {
            $value = $(this).val();

            if($value){
              $('.searchdata').show();
              $('.alldata').hide();
            }else {
              $('.searchdata').hide();
              $('.alldata').show();
            }

            $.ajax({
              type: 'get',
              url: '{{ route('usuarios.search') }}',
              data: {
                'search': $value
              },

              success: function (data) {
                $('#searchdata').html(data);
              }
            });
          })

        });

        /* Filtro de estado y paginacion */
        $('#estado').on('change', function() {
          $(this).closest('#filter_index').submit();
        })

        $('#mostrar').on('change', function() {
          $(this).closest('#filter_index').submit();
        })
      </script>
@endsection
