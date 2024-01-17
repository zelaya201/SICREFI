<div class="row">
  <div class="col-lg-12 mb-4">
    <div class="card h-100">
      <div class="card-header pb-0">
        <span class="fw-bold">Información general</span>
        <hr class="my-2">
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label" for="nom_usuario">Nombre (*)</label>
            <input type="text" class="form-control" name="nom_usuario" id="nom_usuario" value="{{ $usuario->nom_usuario }}">
            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
              <div data-field="name" data-validator="notEmpty" id="nom_usuario_error"></div>
            </div>
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label" for="ape_usuario">Apellido (*)</label>
            <input type="text" class="form-control" name="ape_usuario" id="ape_usuario" value="{{ $usuario->ape_usuario }}">
            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
              <div data-field="name" data-validator="notEmpty" id="ape_usuario_error"></div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label" for="nick_usuario">Usuario (*)</label>
            <input type="text" class="form-control" placeholder="ejemplo1234" name="nick_usuario" id="nick_usuario"
                   value="{{ $usuario->nick_usuario }}">

            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
              <div data-field="name" data-validator="notEmpty" id="nick_usuario_error"></div>
            </div>
          </div>


          <div class="col-md-6 mb-3">
            <label class="form-label" for="id_rol">Rol (*)</label>
            <select class="form-select" id="id_rol" name="id_rol">
              <option> Seleccione un rol</option>
              @foreach($roles as $rol)
                <option value="{{ $rol->id_rol }}" {{ $usuario->id_rol == $rol->id_rol ? 'selected' : '' }}>{{ $rol->nom_rol }}</option>
              @endforeach
            </select>

            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
              <div data-field="name" data-validator="notEmpty" id="id_rol_error"></div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 mb-3">
            <label class="form-label" for="email_usuario">Correo electronico (*)</label>
            <input type="text" class="form-control" placeholder="ejemplo@ejemplo.com"
                   name="email_usuario" id="email_usuario" value="{{ $usuario->email_usuario }}">
            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
              <div data-field="name" data-validator="notEmpty" id="email_usuario_error"></div>
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

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header border-bottom">
        <h4 class="modal-title" id="modal_title"></h4>
      </div>
      <div class="modal-body text-center">
        <p id="modal_body"></p>
      </div>
      <div class="modal-footer border-top">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button id="btn_guardar_usuario" type="button" class="btn"></button>
      </div>
    </div>
  </div>
</div>
