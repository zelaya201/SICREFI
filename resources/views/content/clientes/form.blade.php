<div class="d-flex align-items-center justify-content-between py-3">
  <div class="flex-grow-1">
    <div
      class="d-flex align-items-center justify-content-md-between justify-content-start flex-md-row flex-column gap-4">
      <div class="user-profile-info">
        <h4 class="fw-bold m-0"><span class="text-muted fw-light">Clientes /</span> Nuevo Cliente</h4>
      </div>
      <ul
        class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
        <li class="list-inline-item fw-semibold">
          <button type="button" class="btn rounded-pill btn-icon btn-warning"
                  data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd" aria-controls="offcanvasEnd"
                  data-bs-offset="0,4"
                  data-bs-placement="top" data-bs-html="true" title="Ayuda">
            <span class="tf-icons bx bx-question-mark"></span>
          </button>
        </li>
        <li class="list-inline-item fw-semibold">
          <button class="nav-link btn btn-primary" type="button" id="btn-guardar-cliente"><span
              class="tf-icons bx bx-save"></span> Guardar y continuar
          </button>
        </li>
        <li class="list-inline-item fw-semibold">
          <a class="nav-link btn btn-secondary" type="button" href="{{ route('clientes.index') }}"><span
              class="tf-icons bx bx-arrow-back"></span> <span class="d-none d-sm-inline-block"> Cancelar</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>

{{-- Secciones de Formulario nuevo --}}
<div class="d-flex align-items-center">
  <div class="flex-grow-1">
    <div
      class="d-flex align-items-center flex-md-row flex-column align-items-baseline">
      <button type="button" class="btn" aria-selected="true">
        <span class="btn badge bg-primary"><i class="bx bx-user"></i></span>
        <span class="bs-stepper-title text-primary">Información</span>
      </button>

      <div class="line d-none d-md-inline-block">
        <i class="bx bx-chevron-right"></i>
      </div>

      <button type="button" class="btn" aria-selected="true">
        <span class="btn badge bg-label-secondary"><i class="bx bx-user-check"></i></span>

        <span class="bs-stepper-label mt-1">
              <span class="bs-stepper-title">Conyuge</span>
        </span>
      </button>

      <div class="line d-none d-md-inline-block">
        <i class="bx bx-chevron-right"></i>
      </div>

      <button type="button" class="btn" aria-selected="true">
        <span class="btn badge bg-label-secondary"><i class="bx bx-store-alt"></i></span>

        <span class="bs-stepper-label mt-1">
              <span class="bs-stepper-title">Negocios</span>
        </span>
      </button>

      <div class="line d-none d-md-inline-block">
        <i class="bx bx-chevron-right"></i>
      </div>

      <button type="button" class="btn" aria-selected="true">
        <span class="btn badge bg-label-secondary"><i class="bx bx-user-plus"></i></span>

        <span class="bs-stepper-label mt-1">
              <span class="bs-stepper-title">Referencias</span>
        </span>
      </button>

      <div class="line d-none d-md-inline-block">
        <i class="bx bx-chevron-right"></i>
      </div>

      <button type="button" class="btn" aria-selected="true">
        <span class="btn badge bg-label-secondary"><i class="bx bx-buildings"></i></span>

        <span class="bs-stepper-label mt-1">
              <span class="bs-stepper-title">Bienes</span>
        </span>
      </button>
    </div>

  </div>
</div>

<div class="row pt-3">
  <!-- Datos del Cliente -->
  <div class="col-md-6 mb-4">
    <div class="accordion" id="accordionCliente">
      <div class="card p-2 accordion-item active">
        <h2 class="accordion-header fw-bold" id="clienteHeading">
          <button type="button" class="accordion-button show" data-bs-toggle="collapse" data-bs-target="#clienteOne"
                  aria-expanded="true" aria-controls="clienteOne">
            Datos personales
          </button>
        </h2>

        <div id="clienteOne" class="accordion-collapse collapse show" data-bs-parent="#accordionCliente" style="">
          <div class="accordion-body">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label" for="dui_cliente">DUI (*)</label>

                <input type="text" class="form-control" name="dui_cliente" id="dui_cliente" placeholder="000000000">

                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                  <div data-field="name" data-validator="notEmpty" id="dui_cliente_error"></div>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label" for="primer_nom_cliente">Primer nombre (*)</label>
                <input type="text" class="form-control" name="primer_nom_cliente" id="primer_nom_cliente">
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                  <div data-field="name" data-validator="notEmpty" id="primer_nom_cliente_error"></div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label" for="segundo_nom_cliente">Segundo nombre</label>
                <input type="text" class="form-control" id="segundo_nom_cliente" name="segundo_nom_cliente"/>
              </div>
              <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty" id="segundo_nom_cliente_error"></div>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label" for="tercer_nom_cliente">Tercer nombre</label>
                <input type="text" class="form-control" id="tercer_nom_cliente" name="tercer_nom_cliente"/>
              </div>
              <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                <div data-field="name" data-validator="notEmpty" id="tercer_nom_cliente_error"></div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label" for="primer_ape_cliente">Primer apellido (*)</label>
                <input type="text" class="form-control" name="primer_ape_cliente" id="primer_ape_cliente">
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                  <div data-field="name" data-validator="notEmpty" id="primer_ape_cliente_error"></div>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label" for="segundo_ape_cliente">Segundo apellido</label>
                <input type="text" class="form-control" id="segundo_ape_cliente" name="segundo_ape_cliente"/>
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                  <div data-field="name" data-validator="notEmpty" id="segundo_ape_cliente_error"></div>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label" for="fech_nac_cliente">Fecha de nacimiento (*)</label>
                <input type="date" class="form-control" name="fech_nac_cliente" id="fech_nac_cliente" value="">
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                  <div data-field="name" data-validator="notEmpty" id="fech_nac_cliente_error"></div>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label" for="ocupacion_cliente">Ocupación (*)</label>
                <input type="text" class="form-control" name="ocupacion_cliente" id="ocupacion_cliente">
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                  <div data-field="name" data-validator="notEmpty" id="ocupacion_cliente_error"></div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 mb-3">
                <label class="form-label" for="tipo_vivienda_cliente">Tipo de vivienda (*)</label>
                <select class="form-select" name="tipo_vivienda_cliente" id="tipo_vivienda_cliente">
                  <option value="">Seleccione</option>
                  <option value="Propia">Propia</option>
                  <option value="Alquilada">Alquilada</option>
                  <option value="Familiar">Familiar</option>
                  <option value="Otros">Otros</option>
                </select>

                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                  <div data-field="name" data-validator="notEmpty" id="tipo_vivienda_cliente_error"></div>
                </div>
              </div>


            </div>

            <div class="row">
              <div class="col-md-12 mb-3">
                <label class="form-label" for="dir_cliente">Dirección (*)</label>
                <textarea class="form-control" name="dir_cliente" id="dir_cliente" rows="1"></textarea>
                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                  <div data-field="name" data-validator="notEmpty" id="dir_cliente_error"></div>
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
    </div>
  </div>

  <div class="col-md-6">
    <div class="accordion" id="accordionExample">
      <!-- Gastos personales -->
      <div class="card p-2 mb-4 accordion-item active">
        <h2 class="accordion-header fw-bold" id="headingOne">
          <button type="button" class="accordion-button show" data-bs-toggle="collapse" data-bs-target="#accordionOne"
                  aria-expanded="true" aria-controls="accordionOne">
            Gastos personales
          </button>
        </h2>

        <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample" style="">
          <div class="accordion-body">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label" for="gasto_aliment_cliente">Alimentación (*)</label>
                <input type="text" class="form-control" name="gasto_aliment_cliente" id="gasto_aliment_cliente"
                       placeholder="0.00">

                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                  <div data-field="name" data-validator="notEmpty" id="gasto_aliment_cliente_error"></div>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label" for="gasto_vivienda_cliente">Vivienda (*)</label>
                <input type="text" class="form-control" name="gasto_vivienda_cliente" id="gasto_vivienda_cliente"
                       placeholder="0.00"/>

                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                  <div data-field="name" data-validator="notEmpty" id="gasto_vivienda_cliente_error"></div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label" for="gasto_luz_cliente">Luz (*)</label>
                <input type="text" class="form-control" name="gasto_luz_cliente" id="gasto_luz_cliente"
                       placeholder="0.00">

                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                  <div data-field="name" data-validator="notEmpty" id="gasto_luz_cliente_error"></div>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label" for="gasto_agua_cliente">Agua (*)</label>
                <input type="text" class="form-control" name="gasto_agua_cliente" id="gasto_agua_cliente"
                       placeholder="0.00">

                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                  <div data-field="name" data-validator="notEmpty" id="gasto_agua_cliente_error"></div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label" for="gasto_cable_cliente">Cable (*)</label>
                <input type="text" class="form-control" name="gasto_cable_cliente" id="gasto_cable_cliente"
                       placeholder="0.00">

                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                  <div data-field="name" data-validator="notEmpty" id="gasto_cable_cliente_error"></div>
                </div>
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label" for="gasto_otro_cliente">Otros gastos (*)</label>
                <input type="text" class="form-control" name="gasto_otro_cliente" id="gasto_otro_cliente"
                       placeholder="0.00">

                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                  <div data-field="name" data-validator="notEmpty" id="gasto_otro_cliente_error"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Datos de contacto -->
      <div class="card p-2 mb-4 accordion-item">
        <h2 class="accordion-header fw-bold" id="headingTwo">
          <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                  data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">
            Datos de contacto
          </button>
        </h2>
        <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
             data-bs-parent="#accordionExample" style="">
          <div class="accordion-body">
            <div class="row">
              <div class="col-md-12 mb-3">
                <label class="form-label" for="email_cliente">Correo electrónico (*)</label>
                <input type="email"
                       class="form-control"
                       name="email_cliente"
                       id="email_cliente"
                       placeholder="admin@admin.com"/>

                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                  <div data-field="name" data-validator="notEmpty" id="email_cliente_error"></div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <label class="form-label d-flex align-items-center justify-content-between" for="input-nom-socio">Teléfonos:
                (*)
                <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                        data-bs-target="#telefono-modal">
                  <span class="tf-icons bx bx-plus"></span> Agregar
                </button>
              </label>
              <table class="table table-bordered">
                <thead>
                <tr>
                  <td>Teléfono</td>
                  <td></td>
                </tr>
                </thead>
                <tbody id="lista-telefonos">
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
  </div>
</div>

<!-- Modal agregar telefono -->
<div class="modal fade" id="telefono-modal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white text-center" id="exampleModalLabel1">Nuevo teléfono</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <label for="input-telefono" class="form-label">Teléfono (*)</label>
            <input type="text" id="input-telefono" class="form-control" placeholder="00000000">
            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
              <div data-field="name" data-validator="notEmpty" id="mensaje-telefono"></div>
            </div>
          </div>
        </div>

        <div class="col-12 text-center">
          <button type="button" class="btn btn-primary me-sm-3 me-1 mt-3" id="btn-agregar-telefono"><span
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

{{-- Off canvas de Ayuda--}}
{{--<div class="mt-3">--}}
{{--  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel">--}}
{{--    <div class="offcanvas-header">--}}
{{--      <h5 id="offcanvasEndLabel" class="offcanvas-title">Sección de Ayuda</h5>--}}
{{--      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>--}}
{{--    </div>--}}

{{--    <div class="offcanvas-body mx-0 flex-grow-0">--}}
{{--      <h5>¿Cómo registrar un nuevo cliente?</h5>--}}
{{--      <iframe src="https://www.youtube.com/embed/xcJtL7QggTI?si=ox0HflKK3Jy9A4qJ"--}}
{{--              title="YouTube video player" frameborder="0"--}}
{{--              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"--}}
{{--              allowfullscreen></iframe>--}}
{{--    </div>--}}
{{--  </div>--}}
{{--</div>--}}

