<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\Cliente;
use App\Models\Credito;
use App\Models\CreditoBien;
use App\Models\CreditoReferencia;
use App\Models\Cuota;
use App\Models\Negocio;
use App\Models\Referencia;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CreditoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
      Session::forget('estado_filtro');
      Session::forget('mostrar');


      $query = Credito::query();

      if ($request->input('estado') || $request->input('mostrar')) {
        $estado = $request->input('estado');
        $mostrar = $request->input('mostrar', 10);

        session(['estado_filtro' => $estado, 'mostrar' => $mostrar]);

        if ($estado == 'Todos') {
          $creditos = $query->orderBy('estado_credito','ASC')->orderBy('fecha_vencimiento_credito', 'ASC')->paginate($mostrar);
        }else {
          $creditos = $query->where(['estado_credito' => $estado])->orderBy('fecha_vencimiento_credito', 'ASC')->paginate($mostrar);
        }

        $creditos->map(function ($credito){
          $cliente = Cliente::query()->where('id_cliente', $credito->id_cliente)->first();
          $cliente->nombre_completo = $cliente->primer_nom_cliente . ' ' . $cliente->segundo_nom_cliente . ' ' . $cliente->tercer_nom_cliente . ' ' . $cliente->primer_ape_cliente . ' ' . $cliente->segundo_ape_cliente;

          $credito->cliente = $cliente;

          return $credito;
        });

        return response(view('content.creditos.index', compact('creditos')));
      }

      $creditos = Credito::query()->where(['estado_credito' => 'Vigente'])->orderBy('fecha_vencimiento_credito','ASC')->paginate(10);

      $creditos->map(function ($credito){
        $cliente = Cliente::query()->where('id_cliente', $credito->id_cliente)->first();
        $cliente->nombre_completo = $cliente->primer_nom_cliente . ' ' . $cliente->segundo_nom_cliente . ' ' . $cliente->tercer_nom_cliente . ' ' . $cliente->primer_ape_cliente . ' ' . $cliente->segundo_ape_cliente;

        $credito->cliente = $cliente;

        return $credito;
      });

      return response(view('content.creditos.index', compact('creditos')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
      $clientes = Cliente::query()
        ->select('dui_cliente','primer_nom_cliente', 'segundo_nom_cliente', 'tercer_nom_cliente', 'primer_ape_cliente', 'segundo_ape_cliente', 'id_cliente', 'estado_cliente')
        ->where(['estado_cliente' => 'Activo'])
        ->orderBy('primer_nom_cliente', 'ASC')
        ->get();

      $clientes = $clientes->map(function ($cliente) {
        $cliente->nombre_completo = $cliente->primer_nom_cliente . ' ' . $cliente->segundo_nom_cliente .' ' . $cliente->tercer_nom_cliente . ' ' . $cliente->primer_ape_cliente . ' ' . $cliente->segundo_ape_cliente;

        $credito = Credito::query()
          ->select('id_credito', 'monto_neto_credito', 'tasa_interes_credito', 'n_cuotas_credito', 'frecuencia_credito', 'tipo_credito', 'monto_credito', 'estado_credito', 'id_negocio')
          ->where(['id_cliente' => $cliente->id_cliente, 'estado_credito' => 'Vigente'])
          ->first();

        $cliente->credito = null;

        if($credito){
          /* CALCULAR DEUDA Y PORCENTAJE PAGADO */
          $deudaCredito = Cuota::query()
            ->where(['id_credito' => $credito->id_credito])
            ->where('estado_cuota', 'Pendiente')
            ->sum('total_cuota');

          $deuda_mora = Cuota::query()
            ->where(['id_credito' => $credito->id_credito])
            ->where('estado_cuota', 'Atrasada')
            ->sum('total_cuota');

          $cuotasMora = Cuota::query()
            ->where(['id_credito' => $credito->id_credito, 'estado_cuota' => 'Pendiente'])
            ->where('fecha_pago_cuota', '<', date('Y-m-d'))
            ->sum('total_cuota');

          // Si hay cuotas en mora se le agrega un 5% de interés
          $cuotas_mora = Cuota::query()
            ->where(['id_credito' => $credito->id_credito, 'estado_cuota' => 'Pendiente'])
            ->where('fecha_pago_cuota', '<', date('Y-m-d'))
            ->get();

          if ($cuotasMora > 0) {
            foreach ($cuotas_mora as $cuota_mora) {
              $cuota_mora->mora_cuota = $cuota_mora->total_cuota * 0.05;
              $cuota_mora->estado_cuota = 'Atrasada';
              $cuota_mora->save();
            }

            $deudaCredito += ($cuotasMora * 0.05);
            $credito->estado_credito = 'Mora';
          }else{
            $cuotas_mora = Cuota::query()
              ->where(['id_credito' => $credito->id_credito, 'estado_cuota' => 'Atrasada'])->get();

            if (count($cuotas_mora)> 0) {
              foreach ($cuotas_mora as $cuota_mora) {
                $deudaCredito += $cuota_mora->mora_cuota;
              }

              $credito->estado_credito = 'Mora';
            }
          }

          $cuotasPagadas = Cuota::query()
            ->where(['id_credito' => $credito->id_credito, 'estado_cuota' => 'Pagada'])
            ->sum('total_cuota');

          $porcentajePagado = ($cuotasPagadas * 100) / $credito->monto_credito;

          $credito->renovacion = false;

          if($porcentajePagado >= 75){ // Si el cliente ha pagado al menos el 75% del crédito
            $credito->renovacion = true;

            if($credito->estado_credito == 'Mora'){ // Si el crédito está en mora no aplica renovación
              $credito->renovacion = false;
            }
          }

          $credito->porcentaje_pagado = $porcentajePagado;
          $credito->deuda_credito = $deudaCredito + $deuda_mora;

          /* CARGAR BIENES DEL CREDITO */
          $bienesCredito = CreditoBien::query()
            ->select('id_bien')
            ->where(['id_credito' => $credito->id_credito])
            ->get();

          $credito->bienes = $bienesCredito;

          /* CARGAR REFERENCIAS DEL CREDITO */
          $refCredito = CreditoReferencia::query()
            ->select('id_ref')
            ->where(['id_credito' => $credito->id_credito])
            ->get();

          $credito->referencias = $refCredito;

          $cliente->credito = $credito;
        }

        /* CARGAR REFERENCIAS, NEGOCIOS Y BIENES DEL CLIENTE */
        $referencias = Referencia::query()
          ->select('primer_nom_ref', 'segundo_nom_ref', 'primer_ape_ref', 'segundo_ape_ref', 'id_ref')
          ->where(['id_cliente' => $cliente->id_cliente])
          ->where('estado_ref', 'Activo')
          ->get();

        $negocios = Negocio::query()
          ->select('nom_negocio', 'id_negocio')
          ->where(['id_cliente' => $cliente->id_cliente])
          ->where('estado_negocio', 'Activo')
          ->get();

        $bienes = Bien::query()
          ->select('id_bien', 'nom_bien', 'valor_bien')
          ->where(['id_cliente' => $cliente->id_cliente])
          ->where('estado_bien', 'Activo')
          ->get();

        $cliente->referencias = $referencias;
        $cliente->negocios = $negocios;
        $cliente->bienes = $bienes;

        return $cliente;
      });

      return response(view('content.creditos.create', compact('clientes')));
    }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return Response
   * @throws \Exception
   */
    public function store(Request $request)
    {
      /* Validaciones */
      /* Enviar validaciones como JSON */
      $this->validate($request, Credito::$rules, Credito::$messages);

      /* Validación del monto neto y el valor de los bienes */
      $montoNeto = $request->input('monto_neto_credito');
      $valorBienes = $request->input('valor_bienes');

      if($montoNeto > $valorBienes){
        return response([
          'errors' => [
            'monto_neto_credito' => ['El monto neto del crédito no puede ser mayor al valor de los bienes']
          ]
        ],
          500
        );
      }

      /* Si el crédito es renovació o refinanciamiento */
      if($request->input('tipo_credito') != 'Nuevo'){
        $credito = Credito::query()->where(
          ['id_cliente' => $request->input('id_cliente'), 'estado_credito' => 'Vigente']
        )->first();

        if($credito) {
          $credito->estado_credito = 'Renovado';

          if ($request->input('tipo_credito') == 'Refinanciamiento') {
            $credito->estado_credito = 'Refinanciado';
          }

          if ($credito->save()) {
            $cuotas = Cuota::query()->where(['id_credito' => $credito->id_credito])
              ->get();

            foreach ($cuotas as $cuota) {
              $cuota->estado_cuota = 'Pagada';
              $cuota->save();
            }
          }
        }
      }

      /* Registro del nuevo crédito */
      $credito = new Credito();
      $credito->fecha_emision_credito = date('Y-m-d');
      $credito->estado_credito = 'Vigente';
      $credito->id_coop = 1;
      $credito->fill($request->all());

      $cuotas = $this->generarFechasCuotas(
        $credito->frecuencia_credito,
        $request->input('fech_primer_cuota'),
        $credito->n_cuotas_credito
      );

      $credito->fecha_vencimiento_credito = $cuotas[count($cuotas) - 1]->format('Y-m-d');

      if($credito->save()){
        $bienes = $request->input('bienes');
        $bienes = explode(',', $bienes);

        foreach ($bienes as $id_bien) {
          $credito_bien = new CreditoBien();
          $credito_bien->id_credito = $credito->id_credito;
          $credito_bien->id_bien = $id_bien;
          $credito_bien->save();
        }

        $referencias = $request->input('referencias');
        $referencias = explode(',', $referencias);

        foreach ($referencias as $id_ref) {
          $credito_ref = new CreditoReferencia();
          $credito_ref->id_credito = $credito->id_credito;
          $credito_ref->id_ref = $id_ref;
          $credito_ref->save();
        }

        $capital_cuota = $request->input('monto_neto_credito') / $request->input('n_cuotas_credito');
        $interes_cuota = ($request->input('monto_neto_credito') * ($request->input('tasa_interes_credito') / 100)) / $request->input('n_cuotas_credito');

        foreach ($cuotas as $cuota) {
          $credito_cuota = new Cuota();

          $credito_cuota->fecha_pago_cuota = $cuota->format('Y-m-d');
          $credito_cuota->capital_cuota = $capital_cuota;
          $credito_cuota->interes_cuota = $interes_cuota;
          $credito_cuota->total_cuota = $capital_cuota + $interes_cuota;
          $credito_cuota->mora_cuota = 0;
          $credito_cuota->extra_cuota = 0;
          $credito_cuota->fecha_abono_cuota = null;
          $credito_cuota->estado_cuota = 'Pendiente';
          $credito_cuota->id_credito = $credito->id_credito;
          $credito_cuota->save();
        }

        Session::flash('success', '');
        Session::flash('mensaje', 'Crédito registrado correctamente');
        return response(['success' => true]);
      }

      return response(['success' => false], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


  /**
   * @param int $id_credito
   * @return Response
   */
  public function asignarIncobrable(int $id_credito)
  {
    $credito = Credito::query()->where('id_credito', $id_credito)->first();
    $credito->estado_credito = 'Incobrable';

    if($credito->save()){
      $cuotas = Cuota::query()->where('id_credito', $id_credito)->get();

      foreach ($cuotas as $cuota){
        $cuota->estado_cuota = 'Incobrable';
        $cuota->save();
      }

      Session::flash('success', '');
      Session::flash('mensaje', 'Crédito puesto en estado incobrable');
      return response(['success' => true]);
    }

    return response(['success' => false], 500);
  }

  public function reactivarCredito(int $id_credito){
    $credito = Credito::query()->where('id_credito', $id_credito)->first();
    $credito->estado_credito = 'Vigente';

    if($credito->save()){
      $cuotas = Cuota::query()->where('id_credito', $id_credito)->get();

      foreach ($cuotas as $cuota){
        $cuota->estado_cuota = 'Pendiente';
        $cuota->save();
      }

      Session::flash('success', '');
      Session::flash('mensaje', 'Crédito reactivado');
      return response(['success' => true]);
    }

    return response(['success' => false], 500);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param Request $request
   * @return Response
   * @throws \Exception
   */

  public function calcularFechasCuotas(Request $request): Response
  {
    $frecuencia_pago = $request->input('frecuencia_credito');
    $fecha_primer_pago = $request->input('fech_primer_cuota');
    $n_cuotas = $request->input('n_cuotas_credito');

    $cuotas = $this->generarFechasCuotas($frecuencia_pago, $fecha_primer_pago, $n_cuotas);

    return response($cuotas);
  }

  /**
   * @throws \Exception
   */
  protected function generarFechasCuotas(string $frecuencia_pago, string $fecha_primer_pago, int $n_cuotas): array
  {
    $fechas_cuotas = [];

    $i = 0;
    while ($i < $n_cuotas){
      $fecha = new DateTime($fecha_primer_pago);

      if($frecuencia_pago == 'Quincenal'){
        $dias = 14 * $i;
        $fecha->modify('+' . $dias . ' day');
      }else{
        $fecha->modify('+' . $i . ' ' . $this->obtenerFrecuencia($frecuencia_pago));
      }

      if($fecha->format('N') == 6){
        if($frecuencia_pago == 'Diario'){
          $n_cuotas += 2;
          $i += 2;
        }

        $fecha->modify('+2 day');
      }else if($fecha->format('N') == 7){
        if($frecuencia_pago == 'Diario'){
          $n_cuotas++;
          $i++;
        }

        $fecha->modify('+1 day');
      }

      $fechas_cuotas[] = $fecha;
      $i++;
    }

    return $fechas_cuotas;
  }

  protected function obtenerFrecuencia(string $frecuencia_pago): string
  {
    $frecuencia = '';
    switch ($frecuencia_pago){
      case 'Diario':
        $frecuencia = 'day';
        break;
      case 'Semanal':
        $frecuencia = 'week';
        break;
      case 'Mensual':
        $frecuencia = 'month';
        break;
    }
    return $frecuencia;
  }

  public function buscarCredito(Request $request)
  {
    $output = '';
    $contador = 1;

    $creditos = DB::table('credito')
      ->join('cliente', 'credito.id_cliente', '=', 'cliente.id_cliente')
      ->select('credito.*')
      ->where('cliente.primer_nom_cliente', 'LIKE', '%' . $request->search . '%')
      ->orWhere('cliente.segundo_nom_cliente', 'LIKE', '%' . $request->search . '%')
      ->orWhere('cliente.tercer_nom_cliente', 'LIKE', '%' . $request->search . '%')
      ->orWhere('cliente.primer_ape_cliente', 'LIKE', '%' . $request->search . '%')
      ->orWhere('cliente.segundo_ape_cliente', 'LIKE', '%' . $request->search . '%')
      ->get();

    if ($creditos->isEmpty()) {
      $output = '<tr style="text-align: center;">' .
        '<td colspan="8">No se encontraron resultados</td>' .
        '</tr>';
    }else {
      foreach ($creditos as $credito) {
        $cliente = Cliente::query()->where('id_cliente', $credito->id_cliente)->first();
        $cliente->nombre_completo = $cliente->primer_nom_cliente . ' ' . $cliente->segundo_nom_cliente . ' ' . $cliente->tercer_nom_cliente . ' ' . $cliente->primer_ape_cliente . ' ' . $cliente->segundo_ape_cliente;
        $credito->cliente = $cliente;

        $output.=
          '<tr style="text-align: center;">'.
          '<td>' . $contador . '</td>' .
          '<td>'. $credito->cliente->nombre_completo . '</td>' .
          '<td>$ '. number_format($credito->monto_neto_credito,2) .'</td>'.
          '<td>'. number_format($credito->tasa_interes_credito,2) .' %</td>'.
          '<td>$ '. number_format($credito->monto_credito,2) .'</td>'.
          '<td>'. date('d/m/Y', strtotime($credito->fecha_vencimiento_credito)) .'</td>';

        if($credito->estado_credito == 'Vigente') {
          $output.= '<td><span class="badge rounded-pill bg-label-success">Vigente</span></td>';
        }else if($credito->estado_credito == 'En mora') {
          $output.= '<td><span class="badge rounded-pill bg-label-danger">En mora</span></td>';
        }else if($credito->estado_credito == 'Renovado') {
          $output.= '<td><span class="badge rounded-pill bg-label-secondary">Renovado</span></td>';
        }else if($credito->estado_credito == 'Refinanciado') {
          $output.= '<td><span class="badge rounded-pill bg-label-warning">Refinanciado</span></td>';
        }else if($credito->estado_credito == 'Finalizado') {
          $output.= '<td><span class="badge rounded-pill bg-label-info">Finalizado</span></td>';
        }else if($credito->estado_credito == 'Incobrable') {
          $output.= '<td><span class="badge rounded-pill bg-label-dark">Incobrable</span></td>';
        }

        $output.=
          '<td>
            <div class="dropdown-icon-demo">
              <a href="javascript:void(0);" class="btn dropdown-toggle btn-sm hide-arrow"
                 data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bx bx-dots-vertical-rounded"></i>
              </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="javascript:void(0);"><i
                  class="bx bx-detail me-1"></i> Detalles</a>
              <a class="dropdown-item" href="/creditos/cuotas/'. $credito->id_credito . '/edit"><i class="bx bx-dollar-circle me-1"></i> Cuotas</a>
                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item text-danger" href="javascript:void(0);"><i
                                    class="bx bx-trash me-1"></i>Incobrable</a>

                            </div>
                          </div>
                        </td>
                      </tr>';

        $contador++;
      }
    }
    return response($output);
  }

  /*public function filtrarCredito(Request $request)
  {
    $output = '';
    $contador = 1;

    session(['estado_filtro' => $request->filtro]);

    if ($request->filtro == 'Todos') {
      $creditos = Credito::query()->orderBy('estado_credito','ASC')->orderBy('fecha_vencimiento_credito', 'ASC')->get();
    }else {
      $creditos = Credito::query()->where(['estado_credito' => $request->filtro])->orderBy('fecha_vencimiento_credito', 'ASC')->get();
    }


    if ($creditos->isEmpty()) {
      $output = '<tr style="text-align: center;">' .
        '<td colspan="8">No se encontraron resultados</td>' .
        '</tr>';
    } else {
      foreach ($creditos as $credito) {
        $cliente = Cliente::query()->where('id_cliente', $credito->id_cliente)->first();
        $cliente->nombre_completo = $cliente->primer_nom_cliente . ' ' . $cliente->segundo_nom_cliente . ' ' . $cliente->tercer_nom_cliente . ' ' . $cliente->primer_ape_cliente . ' ' . $cliente->segundo_ape_cliente;
        $credito->cliente = $cliente;

        $output .=
          '<tr style="text-align: center;">' .
          '<td>' . $contador . '</td>' .
          '<td>' . $credito->cliente->nombre_completo . '</td>' .
          '<td>$ ' . number_format($credito->monto_neto_credito, 2) . '</td>' .
          '<td>' . number_format($credito->tasa_interes_credito, 2) . ' %</td>' .
          '<td>$ ' . number_format($credito->monto_credito, 2) . '</td>' .
          '<td>' . date('d/m/Y', strtotime($credito->fecha_vencimiento_credito)) . '</td>';

        if ($credito->estado_credito == 'Vigente') {
          $output .= '<td><span class="badge rounded-pill bg-label-success">Vigente</span></td>';
        } else if ($credito->estado_credito == 'En mora') {
          $output .= '<td><span class="badge rounded-pill bg-label-danger">En mora</span></td>';
        } else if ($credito->estado_credito == 'Renovado') {
          $output .= '<td><span class="badge rounded-pill bg-label-secondary">Renovado</span></td>';
        } else if ($credito->estado_credito == 'Refinanciado') {
          $output .= '<td><span class="badge rounded-pill bg-label-warning">Refinanciado</span></td>';
        } else if ($credito->estado_credito == 'Finalizado') {
          $output .= '<td><span class="badge rounded-pill bg-label-info">Finalizado</span></td>';
        } else if ($credito->estado_credito == 'Incobrable') {
          $output .= '<td><span class="badge rounded-pill bg-label-dark">Incobrable</span></td>';
        }

        $output .=
          '<td>
            <div class="dropdown-icon-demo">
              <a href="javascript:void(0);" class="btn dropdown-toggle btn-sm hide-arrow"
                 data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bx bx-dots-vertical-rounded"></i>
              </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="javascript:void(0);"><i
                  class="bx bx-detail me-1"></i> Detalles</a>
              <a class="dropdown-item" href="/creditos/cuotas/' . $credito->id_credito . '/edit"><i class="bx bx-dollar-circle me-1"></i> Cuotas</a>
                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item text-danger" href="javascript:void(0);"><i
                                    class="bx bx-trash me-1"></i>Incobrable</a>

                            </div>
                          </div>
                        </td>
                      </tr>';

        $contador++;
      }
    }
    return response($output);
  }*/

}
