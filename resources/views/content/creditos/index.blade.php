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
          <a class="nav-link btn btn-primary" type="button" href="{{ route('creditos.create') }}"><span
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


    <form action="" method="GET">
      <div class="card p-3">
        <div class="card-datatable">
          <div class="dataTables_wrapper dt-bootstrap5 no-footer">
            <div class="row my-3">
              <div class="col-md-6">
                <div class="col-md-6">
                  <label>
                    <input type="search" class="form-control"  id="search_bar" placeholder="Buscar..." aria-controls="DataTables_Table_0" onkeyup="search()">
                  </label>
                </div>
              </div>

              <div class="col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-3">
                <div class="invoice_status mb-3 mb-md-0">
                  <select id="estado" name="estado" class="form-select">
                    <option value="Activo" {{ session('estado_filtro') === 'Activo' ? 'selected' : '' }} class="text-capitalize">Activos</option>
                    <option value="Inactivo" {{ session('estado_filtro') === 'Inactivo' ? 'selected' : '' }} class="text-capitalize">Inactivos</option>
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
              <table id="clientes_table" class="table-responsive invoice-list-table table border-top dataTable no-footer dtr-column my-2">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Cliente</th>
                  <th>Monto</th>
                  <th>Porcentaje de pago</th>
                  <th>fecha de vencimiento</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody id="clientes_tbody">
                @php
                $registrosPerPage = 10;
                $contador = ($creditos->currentPage() - 1) * $registrosPerPage + 1;
                @endphp
                @foreach($creditos as $credito)
                  <tr>
                    <td>{{$contador}}</td>
                    <!--Filtro para Nombre-->
                    @if($credito->segundo_nom_cliente == null or $credito->segundo_nom_cliente == null && $credito->tercer_nom_cliente == null)
                      <td>{{$credito->primer_nom_cliente.' '.$credito->primer_ape_cliente.' '.$credito->segundo_ape_cliente}}</td>
                    @elseif($credito->segundo_nom_cliente == null && $credito->segundo_ape_cliente == null or $credito->segundo_nom_cliente == null && $credito->tercer_nom_cliente == null && $credito->segundo_ape_cliente = null)
                      <td>{{$credito->primer_nom_cliente.' '.$credito->primer_ape_cliente}}</td>
                    @elseif($credito->tercer_nom_cliente == null)
                      <td>{{$credito->primer_nom_cliente.' '.$credito->segundo_nom_cliente.' '.$credito->primer_ape_cliente.' '.$credito->segundo_ape_cliente}}</td>
                    @elseif($credito->tercer_nom_cliente == null && $credito->segundo_ape_cliente = null )
                      <td>{{$credito->primer_nom_cliente.' '.$credito->segundo_nom_cliente.' '.$credito->primer_ape_cliente}}</td>
                    @elseif($credito->segundo_ape_cliente == null)
                      <td>{{$credito->primer_nom_cliente.' '.$credito->segundo_nom_cliente.' '.$credito->tercer_nom_cliente.' '.$credito->primer_ape_cliente}}</td>
                    @else
                      <td>{{$credito->primer_nom_cliente.' '.$credito->segundo_nom_cliente.' '.$credito->tercer_nom_cliente.' '.$credito->primer_ape_cliente.' '.$credito->segundo_ape_cliente}}</td>
                    @endif
                    <td>{{$credito->monto}}</td>
                    <td>{{$credito->porcentaje_pago}}</td>
                    <td>{{$credito->fecha_vencimiento}}</td>
                    <!--Filtro para Estado -->
                    @if($credito->estado == 'Activo')
                      <td><span class="badge rounded-pill bg-label-success">Activo</span></td>
                    @elseif($credito->estado == 'Inactivo')
                      <td><span class="badge rounded-pill bg-label-danger">Inactivo</span></td>
                    @endif
                  </tr>
                @endforeach
                </tbody>
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

@endsection

@section('page-script')

@endsection
