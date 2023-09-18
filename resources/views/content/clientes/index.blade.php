@php
  $container = 'container-fluid';
  $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')
@section('title', 'Clientes')
@section('content')
    <div class=" flex-grow-1 container-p-y">
      <div class="d-flex align-items-center justify-content-md-between justify-content-start flex-md-row flex-column mb-4">
        <div class="user-profile-info py-1">
          <h4 class="fw-bold m-0"><span class="text-muted fw-light">Clientes /</span> Cartera de clientes</h4>
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
            <a class="nav-link btn btn-primary" type="button" href="{{ route('clientes.create') }}"><span
                class="tf-icons bx bx-plus"></span> <span class="d-none d-sm-inline-block"> Nuevo cliente</span> </a>
          </li>
        </ul>
      </div>


      <div class="card mb-4">
        <div class="card-widget-separator-wrapper">
          <div class="card-body card-widget-separator">
            <div class="row gy-4 gy-sm-1">
              <div class="col-sm-6 col-lg-3">
                <div class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                  <div>
                    <h3 class="mb-1">Total</h3>
                    <p class="mb-0">Clientes</p>
                  </div>
                  <div class="avatar me-sm-4">
              <span class="avatar-initial rounded bg-label-secondary">
                <i class="bx bx-user bx-sm"></i>
              </span>
                  </div>
                </div>
                <hr class="d-none d-sm-block d-lg-none me-4">
              </div>
              <div class="col-sm-6 col-lg-3">
                <div class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                  <div>
                    <h3 class="mb-1">???</h3>
                    <p class="mb-0">???</p>
                  </div>
                  <div class="avatar me-lg-4">
              <span class="avatar-initial rounded bg-label-secondary">
                <i class="bx bx-file bx-sm"></i>
              </span>
                  </div>
                </div>
                <hr class="d-none d-sm-block d-lg-none">
              </div>
              <div class="col-sm-6 col-lg-3">
                <div class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                  <div>
                    <h3 class="mb-1">$$$</h3>
                    <p class="mb-0">Pagados</p>
                  </div>
                  <div class="avatar me-sm-4">
              <span class="avatar-initial rounded bg-label-secondary">
                <i class="bx bx-check-double bx-sm"></i>
              </span>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-lg-3">
                <div class="d-flex justify-content-between align-items-start">
                  <div>
                    <h3 class="mb-1">$$$</h3>
                    <p class="mb-0">Sin pagar</p>
                  </div>
                  <div class="avatar">
              <span class="avatar-initial rounded bg-label-secondary">
                <i class="bx bx-error-circle bx-sm"></i>
              </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Invoice List Table -->
      <div class="card p-3">
        <div class="card-datatable">
          <div class="dataTables_wrapper dt-bootstrap5 no-footer">
            <div class="row my-3">
              <div class="col-md-6">
                <div class="col-md-6">
                  <label>
                    <input type="search" class="form-control"  id="search_bar" placeholder="Buscar..." aria-controls="DataTables_Table_0" onkeyup="search()">
                  </label>
                </div>
              </div>
              <div class="col-12 col-md-6 d-flex align-items-center justify-content-end flex-column flex-md-row pe-3 gap-md-3">
                <div class="invoice_status mb-3 mb-md-0">
                  <select id="filter_bar" class="form-select">
                    <option value="Activo" class="text-capitalize">Activos</option>
                    <option value="Inactivo" class="text-capitalize">Inactivos</option>
                    <option value="">Todos</option>
                  </select>
                </div>
                <div class="dataTables_length" id="DataTables_Table_0_length"><label><select
                      name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select">
                      <option value="">Mostrar</option>
                      <option value="10">10</option>
                      <option value="25">25</option>
                      <option value="50">50</option>
                    </select></label></div>
              </div>
            </div>

            <div class="table-responsive">
              <table id="clientes_table" class="invoice-list-table table border-top dataTable no-footer dtr-column my-2"
                     aria-describedby="DataTables_Table_0_info">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Dui</th>
                  <th>Cliente</th>
                  <th>Dirección</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody id="clientes_tbody">
                  @php $contador = 1; @endphp
                  @foreach($clientes as $cliente)
                    <tr>
                      <td>{{$contador}}</td>
                      <td>{{$cliente->dui_cliente}}</td>
                      <!--Filtro para Nombre-->
                      @if($cliente->tercer_nom_cliente == null)
                        <td>{{$cliente->primer_nom_cliente.' '.$cliente->segundo_nom_cliente.' '.$cliente->primer_ape_cliente.' '.$cliente->segundo_ape_cliente}}</td>
                      @elseif($cliente->tercer_nom_cliente != null)
                        <td>{{$cliente->primer_nom_cliente.' '.$cliente->segundo_nom_cliente.' '.$cliente->tercer_nom_cliente.' '.$cliente->primer_ape_cliente.' '.$cliente->segundo_ape_cliente}}</td>
                      @endif
                      <td>{{$cliente->dir_cliente}}</td>
                      <!--Filtro para Estado-->
                      @if($cliente->estado_cliente == 'Activo')
                        <td><span class="badge rounded-pill bg-label-success">Activo</span></td>
                      @elseif($cliente->estado_cliente == 'Inactivo')
                        <td><span class="badge rounded-pill bg-label-danger">Inactivo</span></td>
                      @endif
                      <td>
                        <div class="dropdown-icon-demo">
                          <a href="javascript:void(0);" class="btn dropdown-toggle btn-sm hide-arrow"
                             data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </a>
                          <div class="dropdown-menu" style="">
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-show me-1"></i>
                              Ver</a>
                            <a class="dropdown-item" href="{{ route('negocios.show', $cliente->id_cliente) }}"><i class="bx bx-store-alt me-1"></i>
                              Negocios</a>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-building me-1"></i>
                              Bienes</a>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-user-plus me-1"></i>
                              Referencias</a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i>
                              Editar</a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item text-danger" href="javascript:void(0);"><i
                                class="bx bx-trash me-1"></i> Borrar</a>
                          </div>
                        </div>
                      </td>
                    </tr>
                  @php $contador = $contador +1; @endphp
                  @endforeach
                  <tr class='noSearch' style="display:none; text-align: center">
                    <td colspan="6"></td>
                  </tr>
                  <!--

                  <tr>
                    <td>5</td>
                    <td>01245687-8</td>
                    <td>Mario Ernesto Zelaya Lainez</td>
                    <td>Col San Ramón Pje 3 Lt 44, Quezaltepeque</td>
                    <td><span class="badge rounded-pill bg-label-success">Activo</span></td>
                    <td>Acciones</td>
                  </tr>

                  <tr>
                    <td>6</td>
                    <td>08547485-9</td>
                    <td>Kevin Eduardo Ceron Lopez</td>
                    <td>Urb San Antonio Las Palmeras 15 Cl Pte Y10 Av Nte Ptl Baja Plaza Salomé</td>
                    <td><span class="badge rounded-pill bg-label-success">Activo</span></td>
                    <td>Acciones</td>
                  </tr>

                  <tr>
                    <td>7</td>
                    <td>04579685-8</td>
                    <td>Luis Fernando Vaquerano Ramos</td>
                    <td>Bo Candelaria 1 Av Sur No 7, Usulutan</td>
                    <td><span class="badge rounded-pill bg-label-success">Activo</span></td>
                    <td>Acciones</td>
                  </tr>

                  <tr>
                    <td>8</td>
                    <td>01204578-8</td>
                    <td>Julio Antonio Torres Rodriguez</td>
                    <td>Col. Las Delicias Final 4° Cl. Pte. N° 23-B</td>
                    <td><span class="badge rounded-pill bg-label-danger">Inactivo</span></td>
                    <td>Acciones</td>
                  </tr>

                  <tr>
                    <td>9</td>
                    <td>08754986-5</td>
                    <td>Marta Candelaria Ortiz Gomez</td>
                    <td>7 Av Sur No 219 Loc 4</td>
                    <td><span class="badge rounded-pill bg-label-danger">Inactivo</span></td>
                    <td>Acciones</td>
                  </tr>

                  <tr>
                    <td>10</td>
                    <td>06543212-5</td>
                    <td>Ivania Elizabeth Lainez Cruz</td>
                    <td>Blvd Constitución Col Escalón Y 1 Cl Pte No 3538</td>
                    <td><span class="badge rounded-pill bg-label-danger">Inactivo</span></td>
                    <td>Acciones</td>
                  </tr>

                  <tr class='noSearch' style="display:none; text-align: center">
                    <td colspan="6"></td>
                  </tr>
                  -->

                </tbody>
              </table>
            </div>

            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Mostrar 1 de 10 de 50 clientes
                </div>
              </div>
              <div class="col-sm-12 col-md-6 d-flex justify-content-end">
                <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                  <ul class="pagination">
                    <li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous"><a
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

  @if(Session::has('mensaje'))
    <div class="alert alert-primary d-flex" role="alert">
          <span class="badge badge-center rounded-pill bg-primary border-label-primary p-3 me-2"><i
              class="bx bx-command fs-6"></i></span>
      <div class="d-flex flex-column ps-1">
        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">¡Bien hecho!</h6>
        <span>{{ Session::get('mensaje') }}</span>
      </div>
    </div>
  @endif
@endsection

@section('page-script')
  <script>
    function search() {
      const tableReg = document.getElementById('clientes_table');
      const searchText = document.getElementById('search_bar').value.toLowerCase();
      let total = 0;
      // Recorremos todas las filas con contenido de la tabla

      for (let i = 1; i < tableReg.rows.length; i++) {
        // Si el td tiene la clase "noSearch" no se busca en su contenido
        if (tableReg.rows[i].classList.contains("noSearch")) {
          continue;
        }

        let found = false;
        const cellsOfRow = tableReg.rows[i].getElementsByTagName('td');

        // Recorremos todas las celdas
        for (let j = 0; j < cellsOfRow.length-1 && !found; j++) {
          const compareWith = cellsOfRow[j].innerHTML.toLowerCase();

          // Buscamos el texto en el contenido de la celda
          if (searchText.length == 0 || compareWith.indexOf(searchText) > -1) {
            found = true;
            total++;
          }
        }

        if (found) {
          tableReg.rows[i].style.display = '';
        } else {
          //si no ha encontrado ninguna coincidencia, esconde la fila de la tabla
          tableReg.rows[i].style.display = 'none';
        }
      }

      // mostramos las coincidencias
      const lastTR = tableReg.rows[tableReg.rows.length - 1];
      const td = lastTR.querySelector("td");

      lastTR.style.display = ''

      if (searchText == "") {
        lastTR.style.display = 'none'
      }else if (total) {
        td.innerHTML="Se ha" + ((total>1)?"n ":" ") + "encontrado "+total+" coincidencia"+((total>1)?"s":"");
      }else {
        td.innerHTML="No se han encontrado coincidencias";
      }
    }

    /* Filtro por estado */
    $(document).ready(function() {
      $("#filter_bar").on("change", function() {
        let estado = $(this).val()

        $.ajax({
          url: "{{ route('clientes.index') }}",
          type: "GET",
          data: {'estado' : estado},
          success: function (data) {
            //console.log(data)
            let clientes = data.clientes
            let html = ''

            if (clientes.length > 0) {
              for (let i = 0; i < clientes.length; i++) {
                html += '<tr>\
                          <td>' + (i+1) + '</td>\
                          <td>' + clientes[i]['dui_cliente'] + '</td>'
                          + ((clientes[i]['tercer_nom_cliente'] == null) ?
                            '<td>' + clientes[i]['primer_nom_cliente'] + ' ' + clientes[i]['segundo_nom_cliente'] + ' ' + clientes[i]['primer_ape_cliente'] + ' ' + clientes[i]['segundo_ape_cliente'] + '</td>' :
                            '<td>' + clientes[i]['primer_nom_cliente'] + ' ' + clientes[i]['segundo_nom_cliente'] + ' ' + clientes[i]['tercer_nom_cliente'] + ' ' + clientes[i]['primer_ape_cliente'] + ' ' + clientes[i]['segundo_ape_cliente'] + '</td>')
                          + '<td>' + clientes[i]['dir_cliente'] + '</td>'
                          + ((clientes[i]['estado_cliente'] === 'Activo') ?
                            '<td><span class="badge rounded-pill bg-label-success">' + clientes[i]['estado_cliente'] + '</span></td>' :
                            '<td><span class="badge rounded-pill bg-label-danger">' + clientes[i]['estado_cliente'] + '</span></td>')
                          + '<td>\
                                <div class="dropdown-icon-demo">\
                                  <a href="javascript:void(0);" class="btn dropdown-toggle btn-sm hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">\
                                    <i class="bx bx-dots-vertical-rounded"></i>\
                                  </a>\
                                <div class="dropdown-menu" style="">\
                                  <a class="dropdown-item" href="javascript:void(0);">\
                                    <i class="bx bx-show me-1"></i>\
                                    Ver</a>\
                                  <a class="dropdown-item" href="javascript:void(0);">\
                                    <i class="bx bx-store-alt me-1"></i>\
                                    Negocios</a>\
                                  <a class="dropdown-item" href="javascript:void(0);">\
                                    <i class="bx bx-building me-1"></i>\
                                    Bienes</a>\
                                  <a class="dropdown-item" href="javascript:void(0);">\
                                    <i class="bx bx-user-plus me-1"></i>\
                                    Referencias</a>\
                                  <div class="dropdown-divider"></div>\
                                    <a class="dropdown-item" href="javascript:void(0);">\
                                    <i class="bx bx-edit-alt me-1"></i>\
                                      Editar</a>\
                                  <div class="dropdown-divider"></div>\
                                  <a class="dropdown-item text-danger" href="javascript:void(0);">\
                                  <i class="bx bx-trash me-1"></i>\
                                   Borrar</a>\
                                </div>\
                              </div>\
                          </tr>\
                          <tr class="noSearch" style="display:none; text-align: center">\
                            <td colspan="6"></td>\
                          </tr>'
              }
            }else {
              html += '<tr style="text-align: center">\
                        <td colspan="6">No se han encontrado clientes</td>\
                      </tr>'
            }

            $('#clientes_tbody').html(html)
          }
        })
      })
    })
  </script>
@endsection
