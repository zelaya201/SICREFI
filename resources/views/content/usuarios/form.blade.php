<div class="row">
  <div class="col-lg-8 mb-4">
    <div class="card h-100">
      <div class="card-header pb-0">
        <span class="fw-bold">Información general</span>
        <hr class="my-2">
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label" for="nom_usuario">Nombre (*)</label>
            <input type="text" class="form-control" name="nom_usuario" id="nom_usuario" value="">
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label" for="ape_usuario">Apellido (*)</label>
            <input type="text" class="form-control" name="ape_usuario" id="ape_usuario" value="">
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label" for="nick_usuario">Usuario (*)</label>
            <input type="text" class="form-control" placeholder="ejemplo1234" name="nick_usuario" id="nick_usuario" value="">
          </div>


          <div class="col-md-6 mb-3">
            <label class="form-label" for="id_rol">Rol (*)</label>
            <select class="form-select" id="id_rol">
              <option disabled selected> Seleccione un rol</option>

            </select>

            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
              <div data-field="name" data-validator="notEmpty" id="id_rol_error"></div>
            </div>
          </div>
        </div>

        <div class="row">


          <div class="col-md-12 mb-3">
            <label class="form-label" for="email_usuario">Correo electronico (*)</label>
            <input type="text" class="form-control" placeholder="ejemplo@ejemplo.com" name="email_usuario" id="email_usuario" value="">
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
