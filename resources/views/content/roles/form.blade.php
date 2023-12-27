<div class="row">
  <div class="col-lg-6 mb-4">
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
                <td class="text-nowrap fw-medium">Administrator Access <i class="bx bx-info-circle bx-xs" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Allows a full access to the system" data-bs-original-title="Allows a full access to the system"></i></td>
                <td>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="selectAll">
                    <label class="form-check-label" for="selectAll">
                      Select All
                    </label>
                  </div>
                </td>
              </tr>

              <tr>
                <td class="text-nowrap fw-medium">User Management</td>
                <td>
                  <div class="d-flex">
                    <div class="form-check me-3 me-lg-5">
                      <input class="form-check-input" type="checkbox" id="userManagementRead">
                      <label class="form-check-label" for="userManagementRead">
                        Read
                      </label>
                    </div>
                    <div class="form-check me-3 me-lg-5">
                      <input class="form-check-input" type="checkbox" id="userManagementWrite">
                      <label class="form-check-label" for="userManagementWrite">
                        Write
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="userManagementCreate">
                      <label class="form-check-label" for="userManagementCreate">
                        Create
                      </label>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="text-nowrap fw-medium">Content Management</td>
                <td>
                  <div class="d-flex">
                    <div class="form-check me-3 me-lg-5">
                      <input class="form-check-input" type="checkbox" id="contentManagementRead">
                      <label class="form-check-label" for="contentManagementRead">
                        Read
                      </label>
                    </div>
                    <div class="form-check me-3 me-lg-5">
                      <input class="form-check-input" type="checkbox" id="contentManagementWrite">
                      <label class="form-check-label" for="contentManagementWrite">
                        Write
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="contentManagementCreate">
                      <label class="form-check-label" for="contentManagementCreate">
                        Create
                      </label>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="text-nowrap fw-medium">Disputes Management</td>
                <td>
                  <div class="d-flex">
                    <div class="form-check me-3 me-lg-5">
                      <input class="form-check-input" type="checkbox" id="dispManagementRead">
                      <label class="form-check-label" for="dispManagementRead">
                        Read
                      </label>
                    </div>
                    <div class="form-check me-3 me-lg-5">
                      <input class="form-check-input" type="checkbox" id="dispManagementWrite">
                      <label class="form-check-label" for="dispManagementWrite">
                        Write
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="dispManagementCreate">
                      <label class="form-check-label" for="dispManagementCreate">
                        Create
                      </label>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="text-nowrap fw-medium">Database Management</td>
                <td>
                  <div class="d-flex">
                    <div class="form-check me-3 me-lg-5">
                      <input class="form-check-input" type="checkbox" id="dbManagementRead">
                      <label class="form-check-label" for="dbManagementRead">
                        Read
                      </label>
                    </div>
                    <div class="form-check me-3 me-lg-5">
                      <input class="form-check-input" type="checkbox" id="dbManagementWrite">
                      <label class="form-check-label" for="dbManagementWrite">
                        Write
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="dbManagementCreate">
                      <label class="form-check-label" for="dbManagementCreate">
                        Create
                      </label>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="text-nowrap fw-medium">Financial Management</td>
                <td>
                  <div class="d-flex">
                    <div class="form-check me-3 me-lg-5">
                      <input class="form-check-input" type="checkbox" id="finManagementRead">
                      <label class="form-check-label" for="finManagementRead">
                        Read
                      </label>
                    </div>
                    <div class="form-check me-3 me-lg-5">
                      <input class="form-check-input" type="checkbox" id="finManagementWrite">
                      <label class="form-check-label" for="finManagementWrite">
                        Write
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="finManagementCreate">
                      <label class="form-check-label" for="finManagementCreate">
                        Create
                      </label>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="text-nowrap fw-medium">Reporting</td>
                <td>
                  <div class="d-flex">
                    <div class="form-check me-3 me-lg-5">
                      <input class="form-check-input" type="checkbox" id="reportingRead">
                      <label class="form-check-label" for="reportingRead">
                        Read
                      </label>
                    </div>
                    <div class="form-check me-3 me-lg-5">
                      <input class="form-check-input" type="checkbox" id="reportingWrite">
                      <label class="form-check-label" for="reportingWrite">
                        Write
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="reportingCreate">
                      <label class="form-check-label" for="reportingCreate">
                        Create
                      </label>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="text-nowrap fw-medium">API Control</td>
                <td>
                  <div class="d-flex">
                    <div class="form-check me-3 me-lg-5">
                      <input class="form-check-input" type="checkbox" id="apiRead">
                      <label class="form-check-label" for="apiRead">
                        Read
                      </label>
                    </div>
                    <div class="form-check me-3 me-lg-5">
                      <input class="form-check-input" type="checkbox" id="apiWrite">
                      <label class="form-check-label" for="apiWrite">
                        Write
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="apiCreate">
                      <label class="form-check-label" for="apiCreate">
                        Create
                      </label>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="text-nowrap fw-medium">Repository Management</td>
                <td>
                  <div class="d-flex">
                    <div class="form-check me-3 me-lg-5">
                      <input class="form-check-input" type="checkbox" id="repoRead">
                      <label class="form-check-label" for="repoRead">
                        Read
                      </label>
                    </div>
                    <div class="form-check me-3 me-lg-5">
                      <input class="form-check-input" type="checkbox" id="repoWrite">
                      <label class="form-check-label" for="repoWrite">
                        Write
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="repoCreate">
                      <label class="form-check-label" for="repoCreate">
                        Create
                      </label>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="text-nowrap fw-medium">Payroll</td>
                <td>
                  <div class="d-flex">
                    <div class="form-check me-3 me-lg-5">
                      <input class="form-check-input" type="checkbox" id="payrollRead">
                      <label class="form-check-label" for="payrollRead">
                        Read
                      </label>
                    </div>
                    <div class="form-check me-3 me-lg-5">
                      <input class="form-check-input" type="checkbox" id="payrollWrite">
                      <label class="form-check-label" for="payrollWrite">
                        Write
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="payrollCreate">
                      <label class="form-check-label" for="payrollCreate">
                        Create
                      </label>
                    </div>
                  </div>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
          <!-- Permission table -->
        </div>

      </div>
    </div>
  </div>
</div>
