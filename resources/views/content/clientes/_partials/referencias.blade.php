<div class="tab-pane fade pt-3" id="card-referencia" role="tabpanel">
  <div class="row">
    <div class="col-md-12 mb-4">
      <!-- Referencias -->
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
                  <button type="button" class="btn btn-outline-primary" id="btn-nuevo-ref" data-bs-toggle="modal"
                          data-bs-target="#modal-ref"><i class="tf-icon bx bx-plus"></i>Nueva referencia
                  </button>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table border-top dtr-column my-3"
                     id="DataTables_Table_0"
                     aria-describedby="DataTables_Table_0_info">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Dirección</th>
                  <th>Parentesco</th>
                  <th>Ocupación</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody id="tabla-ref">
                <tr>
                  <td colspan="6">No hay resultados</td>
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

<!-- Modal agregar negocio -->
<form action="{{ route('referencias.store') }}" method="post" autocomplete="off" enctype="multipart/form-data"
      id="form-ref">
  @csrf {{-- Security --}}
  <div class="modal fade" id="modal-ref" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg modal-fullscreen-sm-down" role="document">
      <div class="modal-content">

        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white text-center" id="titulo-modal-ref">Nueva referencia</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12 mb-3">
              <div class="pb-0">
                <span class="fw-bold">Información general</span>
                <hr class="my-2">
              </div>
              <div>
                <input type="text" name="id_ref" id="id_ref" class="visually-hidden"/>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="primer_nom_ref" class="form-label">Primer nombre (*)</label>
                    <input type="text" name="primer_nom_ref" id="primer_nom_ref" class="form-control">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="segundo_nom_ref" class="form-label">Segundo nombre</label>
                    <input type="text" name="segundo_nom_ref" id="segundo_nom_ref" class="form-control">
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="tercer_nom_ref" class="form-label">Tercer nombre</label>
                    <input type="text" name="tercer_nom_ref" id="tercer_nom_ref" class="form-control">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="tercer_nom_ref" class="form-label">Primer apellido (*)</label>
                    <input type="text" name="primer_ape_ref" id="primer_ape_ref" class="form-control">
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="primer_ape_ref" class="form-label">Segundo apellido</label>
                    <input type="text" name="segundo_ape_ref" id="segundo_ape_ref" class="form-control">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="ocupacion_ref" class="form-label">Ocupación (*)</label>
                    <input type="text" name="ocupacion_ref" id="ocupacion_ref" class="form-control">
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="parentesco_ref" class="form-label">Parentesco (*)</label>
                    <input type="text" name="parentesco_ref" id="parentesco_ref" class="form-control">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label" for="dir_ref">Dirección (*)</label>
                    <textarea class="form-control" name="dir_ref" id="dir_ref" rows="2"></textarea>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="pb-0">
                <span class="fw-bold">Datos de contacto</span>
                <hr class="my-2">
              </div>
              <div>
                <div class="col-md-12">
                  <label class="form-label d-flex align-items-center justify-content-between">Teléfonos:
                    (*)
                    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                            data-bs-target="#telefono-modal-ref">
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
                    <tbody id="lista-telefonos-ref">
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

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="btn-agregar-ref">
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
