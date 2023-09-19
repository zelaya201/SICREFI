<div class="tab-pane fade pt-3" id="card-conyuge" role="tabpanel">
    <div class="row">
      <div class="col-md-6 mb-4">
        <!-- Datos del conyugue -->
        <div class="card">
          <div class="card-header pb-0">
            <span class="fw-bold">Datos del conyuge</span>
            <hr class="my-2">
          </div>
          <div class="card-body">
            <div class="row">

              <div class="col-md-6 mb-3">
                <label class="form-label" for="primer_nom_conyuge">Primer nombre (*)</label>
                <input type="text" class="form-control" name="primer_nom_conyuge" id="primer_nom_conyuge">
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                  <div data-field="name" data-validator="notEmpty" id="primer_nom_conyuge_error"></div>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label" for="segundo_nom_conyuge">Segundo nombre</label>
                <input type="text" class="form-control" id="segundo_nom_conyuge" name="segundo_nom_conyuge"/>
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                  <div data-field="name" data-validator="notEmpty" id="segundo_nom_conyuge_error"></div>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label" for="tercer_nom_conyuge">Tercer nombre</label>
                <input type="text" class="form-control" id="tercer_nom_conyuge" name="tercer_nom_conyuge"/>
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                  <div data-field="name" data-validator="notEmpty" id="tercer_nom_conyuge_error"></div>
                </div>
              </div>


              <div class="col-md-6 mb-3">
                <label class="form-label" for="primer_ape_conyuge">Primer apellido (*)</label>
                <input type="text" class="form-control" name="primer_ape_conyuge" id="primer_ape_conyuge">
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                  <div data-field="name" data-validator="notEmpty" id="primer_ape_conyuge_error"></div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label" for="segundo_ape_conyuge">Segundo apellido</label>
                <input type="text" class="form-control" id="segundo_ape_conyuge" name="segundo_ape_conyuge"/>
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                  <div data-field="name" data-validator="notEmpty" id="segundo_ape_conyuge_error"></div>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label" for="ocupacion_conyuge">Ocupación (*)</label>
                <input type="text" class="form-control" name="ocupacion_conyuge" id="ocupacion_conyuge">
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                  <div data-field="name" data-validator="notEmpty" id="ocupacion_conyuge_error"></div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 mb-3">
                <label class="form-label" for="dir_conyuge">Dirección (*)</label>
                <textarea class="form-control" name="dir_conyuge" id="dir_conyuge" rows="2"></textarea>
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                  <div data-field="name" data-validator="notEmpty" id="dir_conyuge_error"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
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
                        data-bs-target="#telefono-modal-conyuge">
                  <span class="tf-icons bx bx-plus"></span> Agregar
                </button>
              </label>

              <table class="table table-bordered border-top table-hover" id="tabla-telefonos-conyuge">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Teléfono</th>
                  <th></th>
                </tr>
                </thead>
                <tbody id="lista-telefonos-conyuge">
                <tr>
                  <td colspan="3">No hay resultados</td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>


<form action="{{ route('telsConyuge.store') }}" method="post" autocomplete="off" enctype="multipart/form-data" id="form-telsconyuge">

<!-- Modal agregar telefono conyuge -->
<div class="modal fade" data-bs-backdrop="static" id="telefono-modal-conyuge" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white text-center">Nuevo teléfono</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <label for="tel_conyuge" class="form-label">Teléfono (*)</label>
            <input type="text" id="tel_conyuge" name="tel_conyuge" class="form-control" placeholder="00000000" maxlength="8">
            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
              <div data-field="name" data-validator="notEmpty" id="mensaje-telefono-conyuge"></div>
            </div>
          </div>
        </div>

        <div class="col-12 text-center">
          <button type="button" class="btn btn-primary me-sm-3 me-1 mt-3" id="btn-agregar-telefono-conyuge"><span
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
</form>
