@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Historial crediticio')
@section('content')
  <div class=" flex-grow-1 py-3">
    <div
      class="d-flex align-items-center justify-content-md-between justify-content-start flex-md-row flex-column mb-1">
      <div class="user-profile-info py-1">
        <h4 class="fw-bold m-0"><span class="text-muted fw-light">Clientes /</span> Historial crediticio</h4>
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
          <a class="nav-link btn btn-secondary load" type="button" href="{{ route('clientes.index') }}"><i
              class="bx bx-arrow-back me-1"></i>Atrás
          </a>
        </li>
      </ul>
    </div>

    <div class="mb-2">
      <h4 class="mb-1">
        ID Cliente #{{ $cliente->id_cliente }}
      </h4>
      <p class="mb-0">
        Registrado: {{ $cliente->created_at->format('d/m/Y h:m:s') }}
      </p>
    </div>

    <div class="card mb-4">
      <div class="card-header pb-0">
        <span class="fw-bold">Datos generales</span>
        <hr class="my-2">
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-3">
            <span class="fw-bold">DUI:</span>
            <span>{{ $cliente->dui_cliente }}</span>
          </div>

          <div class="col-md-5">
            <span class="fw-bold">Nombre:</span>
            <span>{{ $cliente->nombre_completo }}</span>
          </div>

          <div class="col-md-4">
            <span class="fw-bold">Correo electrónico:</span>
            <span>{{ $cliente->email_cliente }}</span>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3">
            <span class="fw-bold">Teléfono:</span>
            <span> {{ $cliente->tel_cliente }}</span>
          </div>

          <div class="col-md-5">
            <span class="fw-bold">Dirección:</span>
            <span>{{ $cliente->dir_cliente }}</span>
          </div>

          <div class="col-md-4">
            <span class="fw-bold">Estado:</span>
            <span>
              @if($cliente->estado_cliente == 'Activo')
                <span class="badge rounded-pill bg-label-success">{{ $cliente->estado_cliente }}</span>
              @else
                <span class="badge rounded-pill bg-label-danger">{{ $cliente->estado_cliente }}</span>
              @endif
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="card mb-4">
      <div class="card-widget-separator-wrapper">
        <div class="card-body card-widget-separator">
          <div class="row gy-4 gy-sm-1">
            <div class="col-sm-6 col-lg-3">
              <div class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                <div>
                  <h3 class="mb-1">{{ $total_creditos }}</h3>
                  <p class="mb-0">Total de Créditos</p>
                </div>
                <div class="avatar me-sm-4">
                  <span class="avatar-initial rounded bg-label-primary">
                    <i class="bx bx-dollar-circle bx-sm"></i>
                  </span>
                </div>
              </div>
              <hr class="d-none d-sm-block d-lg-none me-4">
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                <div>
                  <h3 class="mb-1">{{ $cuotas_mora }}</h3>
                  <p class="mb-0">Cuotas en Mora</p>
                </div>
                <div class="avatar me-lg-4">
              <span class="avatar-initial rounded bg-label-danger">
                <i class="bx bx-calculator bx-sm"></i>
              </span>
                </div>
              </div>
              <hr class="d-none d-sm-block d-lg-none">
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                <div>
                  <h3 class="mb-1">${{ number_format($total_desembolsos, 2) }}</h3>
                  <p class="mb-0">Desembolso Total</p>
                </div>
                <div class="avatar me-sm-4">
              <span class="avatar-initial rounded bg-label-warning">
                <i class='bx bx-coin bx-sm'></i>
              </span>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <h3 class="mb-1">{{ $refinanciamientos }}</h3>
                  <p class="mb-0">Refinanciamientos</p>
                </div>
                <div class="avatar">
              <span class="avatar-initial rounded bg-label-dark">
                <i class='bx bx-spreadsheet bx-sm'></i>
              </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Tabla de créditos -->
    <div class="card px-3 py-2">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
          <tr>
            <th>ID</th>
            <th>Monto</th>
            <th>Desembolso</th>
            <th>Interés</th>
            <th>Plazo</th>
            <th>Inicio</th>
            <th>Fin</th>
            <th>Tipo</th>
            <th>Estado</th>
            <th>Documentos</th>
          </tr>
          </thead>

          <tbody>
          @foreach($creditos as $credito)
            <tr>
              <td>{{ $credito->id_credito }}</td>
              <td>${{ number_format($credito->monto_neto_credito, 2) }}</td>
              <td>${{ number_format($credito->desembolso_credito, 2) }}</td>
              <td>{{ number_format($credito->tasa_interes_credito, 4) }}%</td>
              <td>
                {{ $credito->n_cuotas_credito }}
                @if($credito->frecuencia_credito == 'Diario')
                  Dias
                @elseif($credito->frecuencia_credito == 'Semanal')
                  Semanas
                @elseif($credito->frecuencia_credito == 'Mensual')
                  Meses
                @endif
              </td>
              <td>{{ date('d-m-Y', strtotime($credito->fecha_emision_credito)) }}</td>
              <td>{{ date('d-m-Y', strtotime($credito->fecha_vencimiento_credito)) }}</td>
              <td>{{ $credito->tipo_credito }}</td>
              <td>
                @if($credito->estado_credito == 'Vigente')
                  <span class="badge rounded-pill bg-label-info">{{ $credito->estado_credito }}</span>

                @elseif($credito->estado_credito == 'Refinanciado' || $credito->estado_credito == 'Renovado' || $credito->estado_credito == 'Finalizado')
                  <span class="badge rounded-pill bg-label-success">Finalizado</span>
                @else
                  <span class="badge rounded-pill bg-label-danger">{{ $credito->estado_credito }}</span>
                @endif
              </td>
              <td>
                <div class="dropdown-icon-demo">
                  <a href="javascript:void(0);" class="btn dropdown-toggle btn-sm hide-arrow"
                     data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </a>
                  <div class="dropdown-menu">
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
                  </div>
                </div>
              </td>
            </tr>
          @endforeach

          @if(count($creditos) == 0)
            <tr>
              <td colspan="9">No hay créditos registrados</td>
            </tr>
          @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
