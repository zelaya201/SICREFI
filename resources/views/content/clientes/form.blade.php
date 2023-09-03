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
          <button class="nav-link btn btn-primary" type="submit"><span
              class="tf-icons bx bx-save"></span> Guardar
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

<div class="row">
  <!-- Datos del Cliente -->
  <div class="col-md-6 mb-4">
    <div class="card p-4">

      @if(Session::has('mensaje'))
        <div class="alert alert-primary d-flex" role="alert">
                    <span class="badge badge-center rounded-pill bg-primary border-label-primary p-3 me-2">
                      <i class="bx bx-command fs-6"></i>
                    </span>
          <div class="d-flex flex-column ps-1">
            <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">¡Bien hecho!</h6>
            <span>{{ Session::get('mensaje') }}</span>
          </div>
        </div>
      @endif

      <div>
        <h5 class="fw-bold">Datos del Cliente</h5>
        <hr>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label" for="dui_cliente">DUI (*)</label>

          <input type="text"
                 class="form-control @error('dui_cliente') is-invalid @enderror"
                 name="dui_cliente"
                 id="dui_cliente"
                 placeholder="00000000-0" value="{{ old('dui_cliente') }}">
          @error('dui_cliente')
          <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
            <div data-field="name" data-validator="notEmpty">{{ $message }}</div>
          </div>
          @enderror
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label" for="primer_nom_cliente">Primer nombre (*)</label>
          <input type="text"
                 class="form-control @error('primer_nom_cliente') is-invalid @enderror"
                 name="primer_nom_cliente"
                 id="primer_nom_cliente"
                 placeholder=""
                 value="{{ old('primer_nom_cliente') }}">
          @error('primer_nom_cliente')
          <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
            <div data-field="name" data-validator="notEmpty">{{ $message }}</div>
          </div>
          @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label" for="">Segundo nombre</label>
          <input type="text" class="form-control" name="segundo_nom_cliente" value="{{ old('segundo_nom_cliente') }}">
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label" for="">Tercer nombre</label>
          <input type="text" class="form-control" name="tercer_nom_cliente" value="{{ old('tercer_nom_cliente') }}">
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label" for="">Primer apellido (*)</label>
          <input type="text"
                 class="form-control @error('primer_ape_cliente') is-invalid @enderror"
                 name="primer_ape_cliente"
                 id="primer_ape_cliente"
                 value="{{ old('primer_ape_cliente') }}">
          @error('primer_ape_cliente')
          <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
            <div data-field="name" data-validator="notEmpty">{{ $message }}</div>
          </div>
          @enderror
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label" for="">Segundo apellido</label>
          <input type="text"
                 class="form-control"
                 name="segundo_ape_cliente"
                 value="{{ old('segundo_ape_cliente') }}">
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label" for="">Fecha de nacimiento (*)</label>
          <input type="date"
                 class="form-control @error('fech_nac_cliente') is-invalid @enderror"
                 name="fech_nac_cliente"
                 value="{{ old('fech_nac_cliente') }}">
          @error('fech_nac_cliente')
          <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
            <div data-field="name" data-validator="notEmpty">{{ $message }}</div>
          </div>
          @enderror
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label" for="">Ocupación (*)</label>

          <input type="text"
                 class="form-control @error('ocupacion_cliente') is-invalid @enderror"
                 name="ocupacion_cliente"
                 id="ocupacion_cliente"
                 placeholder=""
                 value="{{ old('ocupacion_cliente') }}">
          @error('ocupacion_cliente')
          <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
            <div data-field="name" data-validator="notEmpty">{{ $message }}</div>
          </div>
          @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 mb-3">
          <label class="form-label" for="">Tipo de vivienda (*)</label>

          <select class="form-select @error('tipo_vivienda_cliente') is-invalid @enderror"
                  name="tipo_vivienda_cliente"
                  id="tipo_vivienda_cliente">
            <option value="">Seleccione</option>
            <option value="Propia" @selected(old('tipo_vivienda_cliente') == 'Propia')>Propia</option>
            <option value="Alquilada" @selected(old('tipo_vivienda_cliente') == 'Alquilada')>Alquilada</option>
            <option value="Familiar" @selected(old('tipo_vivienda_cliente') == 'Familia')>Familiar</option>
            <option value="Otros" @selected(old('tipo_vivienda_cliente') == 'Otros')>Otros</option>
          </select>

          @error('tipo_vivienda_cliente')
            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
              <div data-field="name" data-validator="notEmpty">{{ $message }}</div>
            </div>
          @enderror

        </div>
      </div>

      <div class="row">
        <div class="col-md-12 mb-3">
          <label class="form-label" for="">Dirección (*)</label>
          <textarea class="form-control @error('dir_cliente') is-invalid @enderror"
                    name="dir_cliente"
                    rows="3">{{ old('dir_cliente') }}</textarea>
          @error('dir_cliente')
          <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
            <div data-field="name" data-validator="notEmpty">{{ $message }}</div>
          </div>
          @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 mb-3 text-end">
          Los campos marcados con <span class="text-danger">(*)</span> son obligatorios
        </div>
      </div>

    </div>
  </div>

  <div class="col-md-6">
    <!-- Gastos personales -->
    <div class="card p-4 mb-4">
      <div>
        <h5 class="fw-bold">Gastos personales</h5>
        <hr>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label" for="">Alimentación (*)</label>
          <input type="text" class="form-control" name="gasto_aliment_cliente" id="" placeholder="0.00">
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label" for="">Vivienda (*)</label>
          <input type="text" class="form-control" name="gasto_vivienda_cliente" id="" placeholder="0.00">
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label" for="">Luz (*)</label>
          <input type="text" class="form-control" name="gasto_luz_cliente" id="" placeholder="0.00">
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label" for="">Agua (*)</label>
          <input type="text" class="form-control" name="gasto_agua_cliente" id="" placeholder="0.00">
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label" for="">Cable (*)</label>
          <input type="text" class="form-control" name="gasto_cable_cliente" id="" placeholder="0.00">
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label" for="">Otros gastos (*)</label>
          <input type="text" class="form-control" name="gasto_otro_cliente" id="" placeholder="0.00">
        </div>
      </div>
    </div>

    <!-- Datos de contacto -->
    <div class="card p-4">
      <div>
        <h5 class="fw-bold">Datos de contacto</h5>
        <hr>
      </div>

      <div class="row">
        <div class="col-md-12 mb-3">
          <label class="form-label" for="">Correo electrónico (*)</label>
          <input type="email" class="form-control" name="email_cliente" id="" placeholder="juan@juan.com">
        </div>
      </div>

      <div class="col-md-12">
        <label class="form-label d-flex align-items-center justify-content-between" for="input-nom-socio">Teléfonos:
          (*)
          <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#telefonoModal">
            <span class="tf-icons bx bx-plus"></span> Agregar
          </button>
        </label>
        <table class="table table-bordered">
          <thead>
          <tr>
            <td scope="col">#</td>
            <td scope="col">Teléfono</td>
            <td></td>
            <td></td>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td colspan="4">No hay resultados</td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal agregar telefono -->
<div class="modal fade" id="telefonoModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white text-center" id="exampleModalLabel1">Nuevo teléfono</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <label for="nameBasic" class="form-label">Teléfono</label>
            <input type="text" id="nameBasic" class="form-control" placeholder="0000-0000">
          </div>
        </div>

        <div class="col-12 text-center">
          <button type="submit" class="btn btn-primary me-sm-3 me-1 mt-3"><span class="tf-icons bx bx-plus"></span>
            Agregar
          </button>
          <button type="reset" class="btn btn-label-secondary btn-reset mt-3" data-bs-dismiss="modal"
                  aria-label="Close">Cerrar
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
</form>

{{-- Off canvas de Ayuda --}}
<div class="mt-3">
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasEndLabel" class="offcanvas-title">Sección de Ayuda</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body mx-0 flex-grow-0">
      <h5>¿Cómo registrar un nuevo cliente?</h5>
      <iframe src="https://www.youtube.com/embed/xcJtL7QggTI?si=ox0HflKK3Jy9A4qJ"
              title="YouTube video player" frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
              allowfullscreen></iframe>
    </div>
  </div>
</div>
