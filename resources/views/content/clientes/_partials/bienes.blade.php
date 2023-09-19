<div class="tab-pane fade pt-3" id="card-bienes" role="tabpanel">
  <div class="row">
    <div class="col-md-12 mb-4">
      <!-- Bienes -->
      <div class="card p-3">
        <div class="card-datatable">
          <div class="dataTables_wrapper dt-bootstrap5 no-footer">
            <div class="row my-3">
              <div class="col-md-6">
                <label>
                  <input type="search"
                         class="form-control"
                         placeholder="Buscar..."
                         aria-controls="DataTables_Table_0">
                </label>
              </div>
              <div
                class="col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row ">
                <div class="mb-3 mb-md-0">
                  <button type="button" class="btn btn-outline-primary" id="btn-nuevo-bien" data-bs-toggle="modal"
                          data-bs-target="#modal-bien"><i class="tf-icon bx bx-plus"></i>Nuevo bien
                  </button>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table border-top dtr-column my-3">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody id="tabla-bien">
                <tr>
                  <td colspan="3">No hay resultados</td>
                </tr>
                </tbody>
              </table>
            </div>

            <div class="row mx-2">
              <div class="col-sm-12 col-md-6">
                <div class="dataTables_info" role="status" aria-live="polite">Showing 1 to
                  10 of 1 entries
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="dataTables_paginate paging_simple_numbers">
                  <ul class="pagination">
                    <li class="paginate_button page-item previous disabled"><a
                        aria-controls="DataTables_Table_0" aria-disabled="true" role="link" data-dt-idx="previous"
                        tabindex="0" class="page-link">Anterior</a></li>
                    <li class="paginate_button page-item active"><a href="#" aria-controls="DataTables_Table_0"
                                                                    role="link" aria-current="page" data-dt-idx="0"
                                                                    tabindex="0" class="page-link">1</a></li>

                    <li class="paginate_button page-item next" id="DataTables_Table_0_next"><a href="#"
                                                                                               aria-controls="DataTables_Table_0"
                                                                                               role="link"
                                                                                               data-dt-idx="next"
                                                                                               tabindex="0"
                                                                                               class="page-link">Siguiente</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal agregar bien -->
<form action="{{ route('bienes.store') }}" method="post" autocomplete="off" enctype="multipart/form-data"
      id="form-bien">

  <div class="modal fade" data-bs-backdrop="static" id="modal-bien" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-sm" role="document">
      <div class="modal-content">

        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white text-center" id="titulo-modal-bien">Nuevo bien</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body pb-0">
          <div class="row">
            <div class="col-lg-12 mb-3">
              <input type="text" name="id_bien" id="id_bien" class="visually-hidden"/>
              <div class="row">
                <div class="col-md-12 mb-3">
                  <label for="nom_bien" class="form-label">Nombre (*)</label>
                  <textarea name="nom_bien" id="nom_bien" class="form-control" rows="3"
                            placeholder="Descripción"></textarea>
                  <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                    <div data-field="name" data-validator="notEmpty" id="nom_bien_error"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="btn-agregar-bien">
            Agregar
          </button>
          <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal"
                  aria-label="Close">Cerrar
          </button>
        </div>

      </div>
    </div>
  </div>
</form>
