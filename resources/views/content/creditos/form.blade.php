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
              <input class="form-check-input" type="radio" name="tipo_credito" id="check_nuevo" value="Nuevo" checked>
              <label class="form-check-label" for="inlineRadio1">Nuevo</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="tipo_credito" id="check_renovacion" value="Renovación">
              <label class="form-check-label" for="inlineRadio3">Renovación</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="tipo_credito" id="check_refinan"
                     value="Refinanciamiento">
              <label class="form-check-label" for="inlineRadio2">Refinanciamiento</label>
            </div>

          </div>
        </div>

        <div class="row">
          <div class="col-md-12 mb-3">
            <label class="form-label" for="id_cliente">Cliente (*)</label>
            <select class="" name="id_cliente" id="id_cliente">
              <option disabled selected> Seleccione un cliente</option>
              @foreach($clientes as $cliente)
                <option value="{{ $cliente->id_cliente }}">{{ $cliente->dui_cliente }}
                  - {{ $cliente->nombre_completo }}</option>
              @endforeach
            </select>

            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
              <div data-field="name" data-validator="notEmpty" id="id_cliente_error"></div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 mb-3">
            <label class="form-label" for="id_credito">Crédito a refinanciar/renovar</label>
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
            <select class="form-select" name="id_bien" id="id_bien">
              <option disabled> No hay bienes disponibles</option>
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

  <div class="col-lg-6 mb-4">
    <div class="card h-100">
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
            <label class="form-label" for="tasa_interes_credito">Tasa de interés (*)</label>
            <input type="text" class="form-control" name="tasa_interes_credito" id="tasa_interes_credito"
                   placeholder="0.0000%" onkeypress="return filterFloat(event,this);"/>

            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
              <div data-field="name" data-validator="notEmpty" id="tasa_interes_credito_error"></div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label" for="frecuencia_credito">Frecuencia de pago (*)</label>
            <select class="form-select" name="frecuencia_credito" id="frecuencia_credito">
              <option value="">Seleccione</option>
              <option value="Diario">Diario</option>
              <option value="Semanal">Semanal</option>
              <option value="Mensual">Mensual</option>
            </select>

            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
              <div data-field="name" data-validator="notEmpty" id="frecuencia_credito_error"></div>
            </div>
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label" for="n_cuotas_credito">N° de cuotas (*)</label>
            <input type="number" class="form-control" name="n_cuotas_credito" id="n_cuotas_credito"
                   placeholder="0" min="1" value="1">

            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
              <div data-field="name" data-validator="notEmpty" id="n_cuotas_credito_error"></div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 mb-3">
            <label class="form-label" for="fech_primer_cuota">Fecha de primer cuota (*)</label>
            <input type="date" class="form-control" name="fech_primer_cuota" id="fech_primer_cuota">

            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
              <div data-field="name" data-validator="notEmpty" id="fech_primer_cuota_error"></div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3 mb-3">
            <label class="form-label" for="deuda_credito">Deuda</label>
            <input type="text" class="form-control" name="deuda_credito" id="deuda_credito"
                   placeholder="0.00" value="0.00" onkeypress="return filterFloat(event,this);">

            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
              <div data-field="name" data-validator="notEmpty" id="deuda_credito_error"></div>
            </div>
          </div>

          <div class="col-md-3 mb-3">
            <label class="form-label" for="monto_credito">Monto a pagar</label>
            <input type="text" class="form-control" name="monto_credito" id="monto_credito"
                   placeholder="0.00" value="0.00" onkeypress="return filterFloat(event,this);">

            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
              <div data-field="name" data-validator="notEmpty" id="monto_credito_error"></div>
            </div>
          </div>

          <div class="col-md-3 mb-3">
            <label class="form-label" for="desembolso_credito">Desembolso</label>
            <input type="text" class="form-control" name="desembolso_credito" id="desembolso_credito"
                   placeholder="0.00" value="0.00" onkeypress="return filterFloat(event,this);">

            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
              <div data-field="name" data-validator="notEmpty" id="desembolso_credito_error"></div>
            </div>
          </div>

          <div class="col-md-3 mb-3">
            <label class="form-label" for="monto_cuota_credito">Cuota</label>
            <input type="text" class="form-control" name="monto_cuota_credito" id="monto_cuota_credito"
                   placeholder="0.00" value="0.00" onkeypress="return filterFloat(event,this);">

            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
              <div data-field="name" data-validator="notEmpty" id="monto_cuota_error"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header pb-0">
        <span class="fw-bold">Plan de pagos</span>
        <hr class="my-2">
      </div>

      <div class="card-body">
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="table-responsive">
              <table class="table table-hover align-middle text-center" id="tabla_cuotas">
                <thead class="table-light">
                <tr>
                  <th scope="col">N°</th>
                  <th scope="col">Fecha de pago</th>
                  <th scope="col">Capital</th>
                  <th scope="col">Interés</th>
                  <th scope="col">Total</th>
                </tr>
                </thead>
                <tbody id="datos_cuotas">
                <tr>
                  <td colspan="5">No hay cuotas disponibles</td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>


