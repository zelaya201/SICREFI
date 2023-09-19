
  <div class="modal fade" id="modal-eliminar" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="width: 550px;">
      <div class="modal-content">
        <div class="modal-body mt-2">
          <input type="hidden" name="id_cliente" id="id_cliente" value="">
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-1">
                  <h1>
                    <i class="bx bx-error-alt bx-lg text-danger"></i>
                  </h1>
                </div>
                <div class="col-md-10 ms-4 mt-2">
                  <h4><b>Dar de baja a cliente</b></h4>
                  <h6 class="text-secondary fw-normal mt-3">¿Estás seguro que deseas dar de baja al cliente <b id="label_nom_cliente"></b>?</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button id="submit_delete" type="button" class="btn btn-danger">Dar de baja</button>
        </div>
      </div>
    </div>
  </div>
