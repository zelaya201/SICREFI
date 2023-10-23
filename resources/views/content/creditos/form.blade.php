<div class="tab-pane fade show active" id="card-cliente" role="tabpanel">
  <div class="row">
    <div class="col-lg-6 mb-4">
      <div class="card">
        <div class="card-header pb-0">
          <span class="fw-bold">Información general</span>
          <hr class="my-2">
        </div>
        <div class="card-body">

          <div class="row">
            <div class="col-md mb-3 text-center">
              <label class="form-label d-block" for="">Tipo de crédito</label>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipo_credito" id="inlineRadio1" value="Nuevo">
                <label class="form-check-label" for="inlineRadio1">Nuevo</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipo_credito" id="inlineRadio3" value="Renovación">
                <label class="form-check-label" for="inlineRadio3">Renovación</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipo_credito" id="inlineRadio2" value="Refinanciamiento">
                <label class="form-check-label" for="inlineRadio2">Refinanciamiento</label>
              </div>

            </div>
          </div>

          <div class="row">
            <div class="col-md-12 mb-3">
              <label class="form-label" for="id_cliente">Cliente (*)</label>
              <select class="" name="id_cliente" id="id_cliente">
                @foreach($clientes as $cliente)
                  <option value="{{ $cliente->id_cliente }}">{{ $cliente->dui_cliente }} - {{ $cliente->nombre_completo }}</option>
                @endforeach
              </select>

              <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty" id="id_cliente_error"></div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 mb-3">
              <label class="form-label" for="id_credito">Crédito a refinanciar/reonovar (*)</label>
              <select class="" name="id_credito" id="id_credito">

              </select>

              <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty" id="id_credito_error"></div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 mb-3">
              <label class="form-label" for="id_bien">Bienes (*)</label>
              <select class="" name="id_bien" id="id_bien">

              </select>

              <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty" id="id_bien_error"></div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 mb-3 text-end">
              Los campos marcados con <span class="text-danger">(*)</span> son obligatorios
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <span class="fw-bold">Datos del crédito</span>
          <hr class="my-2">
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label" for="monto_neto_credito">Monto (*)</label>
              <input type="text" class="form-control" name="monto_neto_credito" id="monto_neto_credito"
                     placeholder="0.00" onkeypress="return filterFloat(event,this);">

              <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty" id="monto_neto_credito_error"></div>
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label" for="tasa_interes">Tasa de interés (*)</label>
              <input type="text" class="form-control" name="gasto_vivienda_cliente" id="gasto_vivienda_cliente"
                     placeholder="0.0000%" onkeypress="return filterFloat(event,this);"/>

              <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty" id="gasto_vivienda_cliente_error"></div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label" for="frecuencia_credito">Frecuencia de pago (*)</label>
              <select class="form-select" name="frecuencia_credito" id="frecuencia_credito">
                <option>Seleccione</option>
                <option value="Diario">Diario</option>
                <option value="Semanal">Semanal</option>
                <option value="Mensual">Mensual</option>
              </select>

              <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty" id="gasto_luz_cliente_error"></div>
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label" for="gasto_agua_cliente">N° de cuotas (*)</label>
              <input type="number" class="form-control" name="gasto_agua_cliente" id="gasto_agua_cliente"
                     placeholder="0" min="1" value="1" onkeypress="return filterFloat(event,this);">

              <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty" id="gasto_agua_cliente_error"></div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 mb-3">
              <label class="form-label" for="gasto_cable_cliente">Fecha de inicio (*)</label>
              <input type="date" class="form-control" name="gasto_cable_cliente" id="gasto_cable_cliente">

              <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty" id="gasto_cable_cliente_error"></div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 mb-3">
              <label class="form-label" for="gasto_cable_cliente">Deuda</label>
              <input type="text" class="form-control" name="gasto_cable_cliente" id="gasto_cable_cliente"
                     placeholder="0.00" onkeypress="return filterFloat(event,this);" disabled>

              <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty" id="gasto_cable_cliente_error"></div>
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <label class="form-label" for="gasto_cable_cliente">Monto a pagar</label>
              <input type="text" class="form-control" name="gasto_cable_cliente" id="gasto_cable_cliente"
                     placeholder="0.00" onkeypress="return filterFloat(event,this);" disabled>

              <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty" id="gasto_cable_cliente_error"></div>
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <label class="form-label" for="gasto_cable_cliente">Desembolso</label>
              <input type="text" class="form-control" name="gasto_cable_cliente" id="gasto_cable_cliente"
                     placeholder="0.00" onkeypress="return filterFloat(event,this);" disabled>

              <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty" id="gasto_cable_cliente_error"></div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 mb-3 text-center">
              <button type="button" class="btn btn-outline-info w-50" data-bs-toggle="modal"
                      data-bs-target="#modal_cuotas">
                <span class="tf-icons bx bx-calculator"></span> Calcular cuotas
                </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal agregar telefono cliente -->
<form action="" method="post" autocomplete="off" enctype="multipart/form-data"
      id="form-telscliente">

  <div class="modal fade" id="modal_cuotas" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white text-center">Plan de pago</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="row">
            <table class="table table-bordered border-top table-hover" id="tabla-telefonos-cliente">
              <thead>
              <tr>
                <th>#</th>
                <th>Monto cuota</th>
                <th>Fecha</th>
              </tr>
              </thead>
              <tbody id="lista-telefonos-cliente">
              <tr>
                <td colspan="3">No hay resultados</td>
              </tr>
              </tbody>
            </table>
          </div>

          <div class="col-12 text-center">
            <button type="button" class="btn btn-label-secondary mt-3" data-bs-dismiss="modal"
                    aria-label="Close">Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
