<div class="tab-pane fade pt-3" id="card-datos-negocios" role="tabpanel">
  <div class="row">
    <div class="col-md-12 mb-4">
      <!-- Negocios -->
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
                  <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                          data-bs-target="#modal-negocio"><i class="tf-icon bx bx-plus"></i>Nuevo negocio
                  </button>
                </div>
              </div>
            </div>
            <table class="table border-top dtr-column my-3"
                   id="DataTables_Table_0"
                   aria-describedby="DataTables_Table_0_info">
              <thead>
              <tr>
                <th>#
                </th>
                <th>Nombre
                </th>
                <th>Dirección
                </th>
                <th>Tiempo de operación
                </th>
                <th>
                  Acciones
                </th>
              </tr>
              </thead>
              <tbody id="tabla-negocios">
              <tr>
                <td colspan="5">No hay resultados</td>
              </tr>

              </tbody>
            </table>
            <div class="row mx-2">
              <div class="col-sm-12 col-md-6">
                <div class="dataTables_info" role="status" aria-live="polite">Showing 1 to
                  10 of 50 entries
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
                    <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" role="link"
                                                              data-dt-idx="1" tabindex="0" class="page-link">2</a></li>
                    <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" role="link"
                                                              data-dt-idx="2" tabindex="0" class="page-link">3</a></li>
                    <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" role="link"
                                                              data-dt-idx="3" tabindex="0" class="page-link">4</a></li>
                    <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" role="link"
                                                              data-dt-idx="4" tabindex="0" class="page-link">5</a></li>
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
<form action="{{ route('negocios.store') }}" method="post" autocomplete="off" enctype="multipart/form-data"
      id="form-negocio">
  @csrf {{-- Security --}}
  <div class="modal fade" id="modal-negocio" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg modal-fullscreen-sm-down" role="document">
      <div class="modal-content">

        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white text-center">Nuevo negocio</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12 mb-3">
              <div class="pb-0">
                <span class="fw-bold">Datos del negocio</span>
                <hr class="my-2">
              </div>
              <div>
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="nom_negocio" class="form-label">Nombre (*)</label>
                    <input type="text" name="nom_negocio" id="nom_negocio" class="form-control">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="tiempo_negocio" class="form-label">Tiempo de tenerlo (*)</label>
                    <input type="text" name="tiempo_negocio" id="tiempo_negocio" class="form-control"
                           placeholder="Cantidad en meses">
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 mb-3">
                    <label class="form-label" for="dir_negocio">Dirección (*)</label>
                    <textarea class="form-control" name="dir_negocio" id="dir_negocio" rows="2"></textarea>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="buena_venta_negocio" class="form-label">Venta en dia bueno (*)</label>
                    <input type="text" name="buena_venta_negocio" id="buena_venta_negocio" class="form-control"
                           placeholder="0.00">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="mala_venta_negocio" class="form-label">Venta en dia malo (*)</label>
                    <input type="text" name="mala_venta_negocio" id="mala_venta_negocio" class="form-control"
                           placeholder="0.00">
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="ganancia_diaria_negocio" class="form-label">Ganancia diaria (*)</label>
                    <input type="text" name="ganancia_diaria_negocio" id="ganancia_diaria_negocio" class="form-control"
                           placeholder="0.00">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="inversion_diaria_negocio" class="form-label">Inversión diaria (*)</label>
                    <input type="text" name="inversion_diaria_negocio" id="inversion_diaria_negocio"
                           class="form-control" placeholder="0.00">
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12 mb-3">
              <div class="pb-0">
                <span class="fw-bold">Gastos</span>
                <hr class="my-2">
              </div>
              <div>
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="gasto_emp_negocio" class="form-label">Pago de empleados (*)</label>
                    <input type="text" name="gasto_emp_negocio" id="gasto_emp_negocio" class="form-control"
                           placeholder="0.00">
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="gasto_alquiler_negocio" class="form-label">Alquiler de local (*)</label>
                    <input type="text" name="gasto_alquiler_negocio" id="gasto_alquiler_negocio" class="form-control"
                           placeholder="0.00">
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4 mb-3">
                    <label for="gasto_impuesto_negocio" class="form-label">Impuestos (*)</label>
                    <input type="text" name="gasto_impuesto_negocio" id="gasto_impuesto_negocio" class="form-control"
                           placeholder="0.00">
                  </div>

                  <div class="col-md-4 mb-3">
                    <label for="gasto_credito_negocio" class="form-label">Cuotas de créditos (*)</label>
                    <input type="text" name="gasto_credito_negocio" id="gasto_credito_negocio" class="form-control"
                           placeholder="0.00">
                  </div>

                  <div class="col-md-4 mb-3">
                    <label for="gasto_otro_negocio" class="form-label">Otros pagos (*)</label>
                    <input type="text" name="gasto_otro_negocio" id="gasto_otro_negocio" class="form-control"
                           placeholder="0.00">
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
                            data-bs-target="#telefono-modal-negocio">
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
                    <tbody id="lista-telefonos-negocio">
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
          <button type="submit" class="btn btn-primary" id="btn-agregar-negocio"><span
              class="tf-icons bx bx-plus"></span>
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




