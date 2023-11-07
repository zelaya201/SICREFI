@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Créditos')
@section('content')
  <div class=" flex-grow-1 py-3">
    <div
      class="d-flex align-items-center justify-content-md-between justify-content-start flex-md-row flex-column mb-4">
      <div class="user-profile-info py-1">
        <h4 class="fw-bold m-0"><span class="text-muted fw-light">Créditos /</span> Cartera de créditos</h4>
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
          <a class="nav-link btn btn-primary load" type="button" href="{{ route('creditos.create') }}"><span
              class="tf-icons bx bx-plus"></span> <span class="d-none d-sm-inline-block"> Nuevo crédito</span> </a>
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

    <div class="card mb-4">
      <div class="card-widget-separator-wrapper">
        <div class="card-body card-widget-separator">
          <div class="row gy-4 gy-sm-1">
            <div class="col-sm-6 col-lg-3">
              <div class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                <div>
                  <h3 class="mb-1"></h3>
                  <p class="mb-0">Clientes</p>
                </div>
                <div class="avatar me-sm-4">
              <span class="avatar-initial rounded bg-label-secondary">
                <i class="bx bx-user bx-sm"></i>
              </span>
                </div>
              </div>
              <hr class="d-none d-sm-block d-lg-none me-4">
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                <div>
                  <h3 class="mb-1"></h3>
                  <p class="mb-0">Clientes con préstamos</p>
                </div>
                <div class="avatar me-lg-4">
              <span class="avatar-initial rounded bg-label-secondary">
                <i class="bx bx-file bx-sm"></i>
              </span>
                </div>
              </div>
              <hr class="d-none d-sm-block d-lg-none">
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                <div>
                  <h3 class="mb-1"></h3>
                  <p class="mb-0">Clientes Activos</p>
                </div>
                <div class="avatar me-sm-4">
              <span class="avatar-initial rounded bg-label-secondary">
                <i class='bx bx-user-check bx-sm'></i>
              </span>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <h3 class="mb-1"></h3>
                  <p class="mb-0">Clientes Inactivos</p>
                </div>
                <div class="avatar">
              <span class="avatar-initial rounded bg-label-secondary">
                <i class='bx bx-user-minus bx-sm'></i>
              </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <form id="filter_index" action="{{ route('creditos.index') }}" method="get">
      <div class="card p-3">
        <div class="card-datatable">
          <div class="dataTables_wrapper dt-bootstrap5 no-footer">
            <div class="row my-3">
              <div class="col-md-6">
                <div class="col-md-6">
                  <label>
                    <input type="search" class="form-control"  id="search_bar" placeholder="Buscar por cliente...">
                  </label>
                </div>
              </div>

              <div class="col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-3">
                <div class="invoice_status mb-3 mb-md-0">
                  <select id="estado" name="estado" class="form-select">
                    <option value="Vigente" {{ session('estado_filtro') === 'Vigente' ? 'selected' : '' }} class="text-capitalize">Vigentes</option>
                    <option value="En mora" {{ session('estado_filtro') === 'En mora' ? 'selected' : '' }} class="text-capitalize">En mora</option>
                    <option value="Renovado" {{ session('estado_filtro') === 'Renovado' ? 'selected' : '' }} class="text-capitalize">Renovados</option>
                    <option value="Refinanciado" {{ session('estado_filtro') === 'Refinanciado' ? 'selected' : '' }} class="text-capitalize">Refinanciados</option>
                    <option value="Finalizado" {{ session('estado_filtro') === 'Finalizado' ? 'selected' : '' }} class="text-capitalize">Finalizados</option>
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
              <table id="creditos_table" class="table-responsive invoice-list-table table border-top dataTable no-footer dtr-column my-2">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Cliente</th>
                  <th>Monto crédito</th>
                  <th>Interés</th>
                  <th>Monto total</th>
                  <th>Fecha de vencimiento</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody id="clientes_tbody" class="alldata">
                @php
                  $registrosPerPage = 10;
                  $contador = ($creditos->currentPage()-1) * $registrosPerPage + 1;
                  //$contador = 1;
                @endphp
                @if($creditos->isEmpty())
                  <tr>
                    <td colspan="8" class="text-center">No hay registros</td>
                  </tr>
                @else
                  @foreach($creditos as $credito)
                    <tr style="text-align: center;">
                      <td>{{ $contador }}</td>
                      <td>{{ $credito->cliente->nombre_completo }}</td>
                      <td>$ {{ number_format($credito->monto_neto_credito,2) }}</td>
                      <td>{{ number_format($credito->tasa_interes_credito,2) }} %</td>
                      <td>$ {{ number_format($credito->monto_credito,2) }}</td>
                      <td>{{ date('d/m/Y', strtotime($credito->fecha_vencimiento_credito)) }}</td>

                      <!--Filtro para Estado-->
                      @if($credito->estado_credito == 'Vigente')
                        <td><span class="badge rounded-pill bg-label-success">Vigente</span></td>
                      @elseif($credito->estado_credito == 'En mora')
                        <td><span class="badge rounded-pill bg-label-danger">En mora</span></td>
                      @elseif($credito->estado_credito == 'Renovado')
                        <td><span class="badge rounded-pill bg-label-secondary">Renovado</span></td>
                      @elseif($credito->estado_credito == 'Refinanciado')
                        <td><span class="badge rounded-pill bg-label-warning">Refinanciado</span></td>
                      @elseif($credito->estado_credito == 'Finalizado')
                        <td><span class="badge rounded-pill bg-label-info">Finalizado</span></td>
                      @elseif($credito->estado_credito == 'Incobrable')
                        <td><span class="badge rounded-pill bg-label-dark">Incobrable</span></td>
                      @endif

                      <td>
                        <div class="dropdown-icon-demo">
                          <a href="javascript:void(0);" class="btn dropdown-toggle btn-sm hide-arrow"
                             data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </a>
                          <div class="dropdown-menu">
                            @if($credito->estado_credito != 'Incobrable')
                              <a class="dropdown-item" href="javascript:void(0);"><i
                                  class="bx bx-detail me-1"></i> Detalles</a>

                              <a class="dropdown-item" href="{{ route('cuotas.edit', $credito->id_credito) }}"><i class="bx bx-dollar-circle me-1"></i>
                                Cuotas</a>


                              <a class="dropdown-item" target="_blank" href="{{ route('generar-declaracion', $credito->id_credito) }}">
                                <i class="bx bx-file me-1"></i>
                                Declaración Jurada</a>
                              <a class="dropdown-item" target="_blank" href="{{ route('generar-pagare', $credito->id_credito) }}"><i
                                  class="bx bx-credit-card me-1"></i>
                                Pagaré</a>
                              <a class="dropdown-item" target="_blank" href="{{ route('generar-tarjeta', $credito->id_credito) }}"><i
                                  class="bx bx-list-ul me-1"></i>Tarjeta de Pagos</a>
                              <a class="dropdown-item" target="_blank" href="{{ route('generar-recibo', $credito->id_credito) }}"><i
                                  class="bx bx-receipt me-1"></i>Recibo de Crédito</a>

                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item text-danger" onclick="incobrableCredito('{{ $credito->id_credito }}')"><i
                                  class="bx bx-trash me-1"></i>Incobrable</a>
                            @else
                              <a class="dropdown-item text-success" onclick="reactivarCredito('{{ $credito->id_credito }}')"><i
                                  class="bx bx-check me-1"></i>Reactivar</a>
                            @endif
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
                  {{ $creditos->appends(['estado' => session('estado_filtro'), 'mostrar' => session('mostrar')])->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>

    <!-- Modal reactivar -->
    <div class="modal fade" id="modal_credito" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
              url: '{{ route('creditos.search') }}',
              data: {
                'search': $value
              },

              success: function (data) {
                $('#searchdata').html(data);
              }
            });
          })

          btn_accion.on('click', function() {
            let ruta = '';

            if(accion === 'reactivar') {
              ruta = '{{ route('creditos.reactivarCredito', ':id_credito') }}'.replace(':id_credito', id_credito_val);
            } else if(accion === 'incobrable') {
              ruta = '{{ route('creditos.asignarIncobrable', ':id_credito') }}'.replace(':id_credito', id_credito_val);
            }

            $.ajax({
              type: 'get',
              url: ruta,
              success: function (data) {
                if(data.success) {
                  location.reload();
                }
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

        let accion = '';
        const modal_credito = $('#modal_credito');
        let id_credito_val = 0
        const btn_accion = $('#btn_accion');

        const titulo = $('#titulo');
        const descripcion = $('#descripcion');
        const icono = $('#icono');

        /* Modal reactivar */
        function reactivarCredito(id_credito) {
          accion = 'reactivar';
          titulo.html('<b>Reactivar crédito</b>');
          descripcion.html('¿Estás seguro que deseas reactivar el crédito ' + id_credito + '?');
          btn_accion.html('Si, reactivar');
          btn_accion.removeClass('btn-danger');
          btn_accion.addClass('btn-info');
          icono.html('<i class="bx bx-info-circle bx-lg text-info"></i>');

          modal_credito .modal('show');
          id_credito_val = id_credito;
        }

        function incobrableCredito(id_credito) {
          accion = 'incobrable';

          titulo.html('<b>Marcar como incobrable</b>');
          descripcion.html('¿Estás seguro que deseas marcar como incobrable al crédito ' + id_credito + '?');
          btn_accion.html('Si, marcar como incobrable');
          btn_accion.removeClass('btn-info');
          btn_accion.addClass('btn-danger');
          icono.html('<i class="bx bx-info-circle bx-lg text-danger"></i>');

          modal_credito.modal('show');
          id_credito_val = id_credito;
        }

      </script>
@endsection
