<form action="{{route('clientes.destroy', $cliente->id_cliente)}}" method="get" enctype="multipart/form-data">
  <div class="modal fade" id="modal-eliminar{{$cliente->id_cliente}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="width: 550px;">
      <div class="modal-content">
        <div class="modal-header">
          <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
        </div>
        <div class="modal-body mt-2">
          <input type="hidden" name="id_cliente" value="{{$cliente->id_cliente}}">
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-1">
                  <h1>
                    <i class="bx bx-error-alt bx-lg text-danger" style="-webkit-text-stroke: 1px;"></i>
                  </h1>
                </div>
                <div class="col-md-10 ms-4 mt-2">
                  <h4><b>Dar de baja a cliente</b></h4>
                  <h6 class="text-secondary fw-normal mt-3">¿Estás seguro que deseas dar de baja al cliente <b>{{$cliente->primer_nom_cliente.' '.$cliente->primer_ape_cliente}}</b>?</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button id="submit_delete" type="submit" class="btn btn-danger">Dar de baja</button>
        </div>
      </div>
    </div>
  </div>
</form>
