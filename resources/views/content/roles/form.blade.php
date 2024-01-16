<div class="row">
  <div class="col-lg-8 mb-4">
    <div class="card h-100">
      <div class="card-header pb-0">
        <span class="fw-bold">Rol</span>
        <hr class="my-2">
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-md-12 mb-3">
            <label class="form-label" for="nom_rol">Nombre (*)</label>
            <input type="text" class="form-control" name="nom_rol" id="nom_rol">

            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
              <div data-field="name" data-validator="notEmpty" id="nom_rol_error"></div>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="table-responsive">
            <table class="table table-flush-spacing">
              <tbody>
              <tr>
                <td class="text-nowrap fw-medium">Acceso de administrador <i class="bx bx-info-circle bx-xs" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Allows a full access to the system" data-bs-original-title="Allows a full access to the system"></i></td>
                <td>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="selectAll">
                    <label class="form-check-label" for="selectAll">
                      Seleccionar todo
                    </label>
                  </div>
                </td>
              </tr>

              @foreach($opciones as $opcion)
                <tr>
                  <td class="text-nowrap fw-medium">{{ $opcion->nom_opcion_acceso }}</td>
                  <td>
                    <div class="d-flex">
                    @foreach($opcion->detalles as $detalle)

                        <div class="form-check me-3 me-lg-5">
                          <input class="form-check-input" type="checkbox" id="userManagementRead">
                          <label class="form-check-label" for="userManagementRead">
                            {{ $detalle->nom_detalle_acceso }}
                          </label>
                        </div>

                    @endforeach
                    </div>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- Permission table -->
        </div>

      </div>
    </div>
  </div>
</div>
