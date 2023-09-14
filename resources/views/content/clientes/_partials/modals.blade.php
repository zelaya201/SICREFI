{{-- MODALS DE NUEVO --}}


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

<!-- Modal agregar telefono conyuge -->
<div class="modal fade" id="telefono-modal-conyuge" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white text-center">Nuevo teléfono</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <label for="input-telefono-conyuge" class="form-label">Teléfono (*)</label>
            <input type="text" id="input-telefono-conyuge" class="form-control" placeholder="00000000">
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
