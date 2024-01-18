@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Cobros rápidos')
@section('content')
  <div class=" flex-grow-1 py-3">
    <div
      class="d-flex align-items-center justify-content-md-between justify-content-start flex-md-row flex-column mb-3">
      <div class="user-profile-info py-1">
        <h4 class="fw-bold m-0"><span class="text-muted fw-light">Cobros /</span> Cobros rápidos</h4>
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
          <a class="nav-link btn btn-secondary load" type="button" href="{{ route('creditos.index') }}"><i
              class="bx bx-arrow-back me-1"></i>Atrás
          </a>
        </li>
      </ul>
    </div>

    @if(Session::has('success'))
      <div class="alert alert-primary d-flex m-0 mt-3 mb-3" role="alert">
          <span class="badge badge-center rounded-pill bg-primary border-label-primary p-3 me-2"><i
              class="bx bx-user fs-6"></i></span>
        <div class="d-flex flex-column ps-1">
          <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Mensaje de éxito</h6>
          <span>{{ Session::get('success') }}</span>
        </div>
      </div>
    @endif

    <div class="card mb-4">
      <div class="card-header pb-0">

        <span class="fw-bold">Cuotas de Hoy</span>
        <hr class="my-2">
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-striped">
            <thead>
            <tr>
              <th>N°</th>
              <th>Fecha</th>
              <th>Cliente</th>
              <th>Crédito</th>
              <th>Cuota</th>
              <th>Mora</th>
              <th>Total</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cuotas as $cuota)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ date('d-m-Y', strtotime($cuota->fecha_pago_cuota)) }}</td>
                  <td>{{ $cuota->nom_completo }}</td>
                  <td>{{ $cuota->credito->id_credito }}</td>
                  <td>${{ number_format($cuota->total_cuota,2) }}</td>
                  <td>${{ number_format($cuota->mora_cuota, 2) }}</td>
                  <td class="text-primary">${{ number_format($cuota->total_pagar,2) }}</td>
                  <td>
                    @if($cuota->estado_cuota == 'Pagada')
                      <span class="badge rounded-pill bg-label-success">{{ $cuota->estado_cuota }}</span>
                    @elseif($cuota->estado_cuota == 'Pendiente')
                      <span class="badge rounded-pill bg-label-info">{{ $cuota->estado_cuota }}</span>
                    @else
                      <span class="badge rounded-pill bg-label-danger">{{ $cuota->estado_cuota }}</span>
                     @endif
                  <td>
                    <div class="dropdown-icon-demo">
                      <a href="javascript:void(0);" class="btn dropdown-toggle btn-sm hide-arrow"
                         data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </a>
                      <div class="dropdown-menu">
                        @if($cuota->estado_cuota == 'Pendiente')
                          @if($cuota->anterior_pagada)
                            <a class="dropdown-item" href="javascript:void(0);"
                               onclick="confirmarPago('{{ route('cuotas.pagarCuota', $cuota->id_cuota) }}','{{ $cuota->nom_completo }}', {{ $cuota->total_cuota }}, {{ $cuota->mora_cuota }}, {{ $cuota->total_pagar }}, '{{ $cuota->estado_cuota }}')"
                            >
                              <i class="bx bx-coin me-1"></i>
                              Pagar</a>
                          @endif
                          <a class="dropdown-item" href="{{ route('cuotas.posponerCuota', $cuota->id_cuota) }}"><i
                              class="bx bx-calendar me-1"></i>Posponer</a>
                        @else
                          <a class="dropdown-item" href="{{ route('generar-ticket', $cuota->id_cuota) }}" target="_blank"><i
                              class="bx bx-detail me-1"></i>Comprobante</a>
                        @endif
                      </div>
                    </div>
                  </td>
                </tr>
            @endforeach

            @if(count($cuotas) == 0) <tr><td colspan="9">No hay cuotas para pagar</td></tr> @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="card mb-2">
      <div class="card-header pb-0">

        <span class="fw-bold">Cuotas Atrasadas</span>
        <hr class="my-2">
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-striped">
            <thead>
            <tr>
              <th>N°</th>
              <th>Fecha</th>
              <th>Cliente</th>
              <th>Crédito</th>
              <th>Cuota</th>
              <th>Mora</th>
              <th>Total</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cuotas_mora as $cuota)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ date('d-m-Y', strtotime($cuota->fecha_pago_cuota)) }}</td>
                <td>{{ $cuota->nom_completo }}</td>
                <td>{{ $cuota->credito->id_credito }}</td>
                <td>${{ number_format($cuota->total_cuota,2) }}</td>
                <td>${{ number_format($cuota->mora_cuota, 2) }}</td>
                <td class="text-primary">${{ number_format($cuota->total_pagar,2) }}</td>
                <td>
                  @if($cuota->estado_cuota == 'Pagada')
                    <span class="badge rounded-pill bg-label-success">{{ $cuota->estado_cuota }}</span>
                  @elseif($cuota->estado_cuota == 'Pendiente')
                    <span class="badge rounded-pill bg-label-info">{{ $cuota->estado_cuota }}</span>
                  @else
                    <span class="badge rounded-pill bg-label-danger">{{ $cuota->estado_cuota }}</span>
                @endif
                <td>
                  <div class="dropdown-icon-demo">
                    <a href="javascript:void(0);" class="btn dropdown-toggle btn-sm hide-arrow"
                       data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="javascript:void(0);"
                         onclick="confirmarPago('{{ route('cuotas.pagarCuota', $cuota->id_cuota) }}','{{ $cuota->nom_completo }}', {{ $cuota->total_cuota }}, {{ $cuota->mora_cuota }}, {{ $cuota->total_pagar }}, '{{ $cuota->estado_cuota }}')"
                      >
                        <i class="bx bx-coin me-1"></i>
                        Pagar</a>
                    </div>
                  </div>
                </td>
              </tr>
            @endforeach

            @if(count($cuotas_mora) == 0) <tr><td colspan="9">No hay cuotas atrasadas</td></tr> @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
       aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header border-bottom">
          <h4 class="modal-title" id="modal_title">
            <i class="bx bx-check-circle bx-lg text-success"></i> <b>Confirmar acción</b>
          </h4>
        </div>
        <div class="modal-body text-center">
          <p id="modal_body">
            ¿Estás seguro que deseas pagar la cuota?
            <ul class="text-start">
              <li>Cliente: <b id="text_cliente"></b></li>
              <li>Monto: <b id="text_monto"></b></li>
              <li>Mora: <b id="text_mora"></b></li>
              <li>Total: <b id="text_total"></b></li>
              <li>Estado: <b id="text_estado"></b></li>
            </ul>
          </p>
        </div>
        <div class="modal-footer border-top">
          <button type="button" class="btn btn-secondary load" data-bs-dismiss="modal">Cancelar</button>
          <button id="modal_submit" type="submit" class="btn btn-success">Si, pagar</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('page-script')
  <script>

    const modal = $('#modal');
    const text_cliente = $('#text_cliente');
    const text_monto = $('#text_monto');
    const text_mora = $('#text_mora');
    const text_total = $('#text_total');
    const text_estado = $('#text_estado');
    const modal_submit = $('#modal_submit');

    let url = '';

    $(document).ready(function () {
      modal_submit.click(function () {
        modal.modal('hide');
        window.location.href = url;
      });
    });

    function confirmarPago(ruta, cliente, cuota, mora, total, estado){
      text_cliente.text(cliente);
      text_monto.text('$' + cuota.toFixed(2));
      text_mora.text('$' + mora.toFixed(2));
      text_total.text('$' + total.toFixed(2));
      text_estado.text(estado);
      modal.modal('show');
      url = ruta;
    }
  </script>
@endsection


