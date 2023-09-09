<div class="tab-pane fade pt-3" id="card-datos-negocios" role="tabpanel">
  <div class="row">
    <div class="col-xl-12 col-lg-7 order-1 order-md-1">
      <!-- Project table -->
      <div class="card mb-4">
        <div class="row m-3">
          <div class="col-12 col-md-6 d-flex align-items-center justify-content-center justify-content-md-start gap-3">
            <div class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start mt-md-0 mt-3">
              <div class="dt-buttons">
                <button class="dt-button btn btn-outline-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                  <span>
                    <i class="bx bx-plus me-md-1"></i>
                      Agregar
                  </span>
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="table-responsive mb-3">
          <div class="table-responsive text-nowrap">
            <table class="table table-hover border-top">
              <thead>
              <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Acciones</th>
              </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                <tr>
                  <td colspan="5">No hay resultados</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
      <div class="col-md-6 mb-4">
        <div class="card">
          <div class="card-header pb-0">
            <span class="fw-bold">Datos del negocio</span>
            <hr class="my-2">
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="" class="form-label">Nombre (*)</label>
                <input type="text" id="" class="form-control">
              </div>

              <div class="col-md-6 mb-3">
                <label for="" class="form-label">Tiempo de tenerlo (*)</label>
                <input type="text" id="" class="form-control" placeholder="Cantidad en años">
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 mb-3">
                <label class="form-label" for="">Dirección (*)</label>
                <textarea class="form-control" id="" rows="2"></textarea>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="" class="form-label">Venta en dia bueno (*)</label>
                <input type="text" id="" class="form-control" placeholder="0.00">
              </div>

              <div class="col-md-6 mb-3">
                <label for="" class="form-label">Venta en dia malo (*)</label>
                <input type="text" id="" class="form-control" placeholder="0.00">
              </div>


            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="" class="form-label">Ganancia diaria (*)</label>
                <input type="text" id="" class="form-control" placeholder="0.00">
              </div>

              <div class="col-md-6 mb-3">
                <label for="" class="form-label">Inversión diaria (*)</label>
                <input type="text" id="" class="form-control" placeholder="0.00">
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

      <div class="col-md-6">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <span class="fw-bold">Gastos</span>
            <hr class="my-2">
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="" class="form-label">Pago de empleados (*)</label>
                <input type="text" id="" class="form-control" placeholder="0.00">
              </div>

              <div class="col-md-6 mb-3">
                <label for="" class="form-label">Alquiler de local (*)</label>
                <input type="text" id="" class="form-control" placeholder="0.00">
              </div>
            </div>

            <div class="row">
              <div class="col-md-4 mb-3">
                <label for="" class="form-label">Impuestos (*)</label>
                <input type="text" id="" class="form-control" placeholder="0.00">
              </div>

              <div class="col-md-4 mb-3">
                <label for="" class="form-label">Cuotas de créditos (*)</label>
                <input type="text" id="" class="form-control" placeholder="0.00">
              </div>

              <div class="col-md-4 mb-3">
                <label for="" class="form-label">Otros pagos (*)</label>
                <input type="text" id="" class="form-control" placeholder="0.00">
              </div>
            </div>
          </div>
        </div>

        <!-- Datos de contacto -->
        <div class="card mb-4">
          <div class="card-header pb-0">
            <span class="fw-bold">Datos de contacto</span>
            <hr class="my-2">
          </div>
          <div class="card-body">
            <div class="col-md-12">
              <label class="form-label d-flex align-items-center justify-content-between">Teléfonos:
                (*)
                <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                        data-bs-target="#telefono-modal-cliente">
                  <span class="tf-icons bx bx-plus"></span> Agregar
                </button>
              </label>

              <table class="table table-bordered border-top table-hover">
                <thead>
                <tr>
                  <th>Teléfono</th>
                  <th></th>
                </tr>
                </thead>
                <tbody id="lista-telefonos-cliente">
                <tr>
                  <td colspan="2">No hay resultados</td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  <!-- Modal agregar telefono cliente -->
  <div class="modal fade" id="telefono-modal-cliente" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white text-center">Nuevo teléfono</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label for="input-telefono-cliente" class="form-label">Teléfono (*)</label>
              <input type="text" id="input-telefono-cliente" class="form-control" placeholder="00000000">
              <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty" id="mensaje-telefono-cliente"></div>
              </div>
            </div>
          </div>

          <div class="col-12 text-center">
            <button type="button" class="btn btn-primary me-sm-3 me-1 mt-3" id="btn-agregar-telefono-cliente"><span
                class="tf-icons bx bx-plus"></span>
              Agregar
            </button>
            <button type="button" class="btn btn-label-secondary mt-3" data-bs-dismiss="modal"
                    aria-label="Close">Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>




