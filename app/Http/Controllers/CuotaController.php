<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Credito;
use App\Models\Cuota;
use Illuminate\Http\Request;

class CuotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $cuotas_mora = Cuota::query()
        ->where(['estado_cuota' => 'Pendiente'])
        ->where('fecha_pago_cuota', '<', date('Y-m-d'))
        ->get();

      if(count($cuotas_mora) > 0) {
        foreach ($cuotas_mora as $cuota_mora) {
          $cuota_mora->estado_cuota = 'Atrasada';
          $cuota_mora->mora_cuota = 0.05 * $cuota_mora->total_cuota;
          $cuota_mora->save();
        }
      }

      $cuotas = Cuota::query()
        ->where('fecha_pago_cuota', '=', date('Y-m-d'))
        ->get();

      $cuotas->map(function ($cuota) {
        $cuotas_morosas = Cuota::query()
          ->where(['id_credito' => $cuota->id_credito])
          ->where(['estado_cuota' => 'Atrasada'])->get();

        $cuota->anterior_pagada = true;

        foreach ($cuotas_morosas as $cuota_morosa) {
          if($cuota_morosa->id_credito == $cuota->id_credito && $cuota_morosa->id_cuota < $cuota->id_cuota) {
            $cuota->anterior_pagada = false;
          }
        }

        if($cuota != null) {
          $cuota->cliente = Cliente::query()->where('id_cliente', $cuota->credito->id_cliente)->first();
          $cuota->nom_completo = $cuota->cliente->primer_nom_cliente . ' ' . $cuota->cliente->segundo_nom_cliente . ' ' . $cuota->cliente->tercer_nom_cliente . ' ' . $cuota->cliente->primer_ape_cliente . ' ' . $cuota->cliente->segundo_ape_cliente;
          $cuota->total_pagar = $cuota->total_cuota + $cuota->mora_cuota;
        }
        return $cuota;
      });

      $cuotas_mora = Cuota::query()
        ->where(['estado_cuota' => 'Atrasada'])->get();

      $cuotas_mora->map(function ($cuota){
        $cuota->cliente = Cliente::query()->where('id_cliente', $cuota->credito->id_cliente)->first();
        $cuota->nom_completo = $cuota->cliente->primer_nom_cliente . ' ' . $cuota->cliente->segundo_nom_cliente . ' ' . $cuota->cliente->tercer_nom_cliente . ' ' . $cuota->cliente->primer_ape_cliente . ' ' . $cuota->cliente->segundo_ape_cliente;
        $cuota->total_pagar = $cuota->total_cuota + $cuota->mora_cuota;

        return $cuota;
      });

        return response()
          ->view('content.cuotas.index', [
            'cuotas' => $cuotas,
            'cuotas_mora' => $cuotas_mora,
          ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $credito = Credito::query()->where('id_credito', $id)->first();

      $cliente = Cliente::query()->select(
        'dui_cliente',
        'primer_nom_cliente',
        'segundo_nom_cliente',
        'tercer_nom_cliente',
        'primer_ape_cliente',
        'segundo_ape_cliente'
      )->where('id_cliente', $credito->id_cliente)->first();

      $cliente->nom_completo = $cliente->primer_nom_cliente . ' ' . $cliente->segundo_nom_cliente . ' ' . $cliente->tercer_nom_cliente . ' ' . $cliente->primer_ape_cliente . ' ' . $cliente->segundo_ape_cliente;

      $cuotaAPagar = Cuota::query()
        ->where('id_credito', $id)
        ->where('estado_cuota', 'Atrasada')->first();

      if($cuotaAPagar == null) {
        $cuotaAPagar = Cuota::query()
          ->where('id_credito', $id)
          ->where('estado_cuota', 'Pendiente')->first();

        if($cuotaAPagar) {
          if ($cuotaAPagar->fecha_pago_cuota < date('Y-m-d') && $cuotaAPagar->estado_cuota == 'Pendiente') {
            $cuotaAPagar->estado_cuota = 'Atrasada';
            $cuotaAPagar->mora_cuota = 0.05 * $cuotaAPagar->total_cuota;
            $cuotaAPagar->save();
          }
        }else{
          $cuotaAPagar = new Cuota();
          $cuotaAPagar->id_cuota = 0;
        }
      }

      $cuotaAPagar->total_pagar = $cuotaAPagar->total_cuota + $cuotaAPagar->mora_cuota;

      $cuotas = Cuota::query()->where('id_credito', $id)->get();

      $total_pagado = 0;
      $total_pendiente = 0;
      $cuotas_pagadas = 0;
      $cuotas_pendientes = 0;

      foreach ($cuotas as $cuota) {
        if($cuota->estado_cuota == 'Pagada') {
          $total_pagado += $cuota->total_cuota;
          $cuotas_pagadas++;
        }else{
          $total_pendiente += $cuota->total_cuota + $cuota->mora_cuota;
          $cuotas_pendientes++;
        }
      }

      return response()->view(
        'content.cuotas.edit',
        [
          'credito' => $credito,
          'cuotas' => $cuotas,
          'cliente' => $cliente,
          'cuotaAPagar' => $cuotaAPagar,
          'total_pagado' => $total_pagado,
          'cuotas_pagadas' => $cuotas_pagadas,
          'total_pendiente' => $total_pendiente,
          'cuotas_pendientes' => $cuotas_pendientes
        ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      $cuota = Cuota::query()->where('id_cuota', $id)->first();

      $cuota->extra_cuota = $request->input('extra_cuota');
      $cuota->fecha_abono_cuota = date('Y-m-d');
      $cuota->estado_cuota = 'Pagada';
      $cuota->save();

      $cuotas = Cuota::query()->where('id_credito', $cuota->id_credito)
        ->where('estado_cuota', '!=', 'Pagada')
        ->get();

      if(count($cuotas) == 0) {
        $credito = Credito::query()->where('id_credito', $cuota->id_credito)->first();
        $credito->estado_credito = 'Finalizado';
        $credito->save();

        return redirect()
          ->route('creditos.index', $credito->id_credito)
          ->with('success', '')
          ->with('mensaje', 'Crédito pagado con éxito');
      }

      return redirect()
        ->route('cuotas.edit', $cuota->id_credito)
        ->with('success', '')
        ->with('mensaje', 'Cuota pagada con éxito');
    }

    /**
     * Pagar cuota de un crédito
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function pagarCredito($id)
    {
      $credito = Credito::query()->where('id_credito', $id)->first();
      $cuotas = Cuota::query()->where('id_credito', $id)->get();

      foreach ($cuotas as $cuota) {
        $cuota->extra_cuota = 0;
        $cuota->fecha_abono_cuota = date('Y-m-d');
        $cuota->estado_cuota = 'Pagada';
        $cuota->save();
      }

      $credito->estado_credito = 'Finalizado';
      $credito->save();

      return redirect()
        ->route('creditos.index', $credito->id_credito)
        ->with('success', '')
        ->with('mensaje', 'Crédito pagado con éxito');
    }

    /**
     * Pagar cuota de un crédito
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function pagarCuota($id)
    {
      $cuota = Cuota::query()->where('id_cuota', $id)->first();

      $cuota->extra_cuota = 0;
      $cuota->fecha_abono_cuota = date('Y-m-d');
      $cuota->estado_cuota = 'Pagada';
      $cuota->save();

      $cuotas = Cuota::query()->where('id_credito', $cuota->id_credito)
        ->where('estado_cuota', '!=', 'Pagada')
        ->get();

      if(count($cuotas) == 0) {
        $credito = Credito::query()->where('id_credito', $cuota->id_credito)->first();
        $credito->estado_credito = 'Finalizado';
        $credito->save();
      }

      return redirect()
        ->route('cuotas.index', $cuota->id_credito)
        ->with('success', '')
        ->with('mensaje', 'Cuota pagada con éxito');
    }

    /**
     * Posponer cuota de un crédito
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function posponerCuota($id){
      $cuota = Cuota::query()->where('id_cuota', $id)->first();
      $cuota->fecha_pago_cuota = date('Y-m-d', strtotime($cuota->fecha_pago_cuota . ' + 1 day'));
      $cuota->save();

      return redirect()
        ->route('cuotas.index', $cuota->id_credito)
        ->with('success', '')
        ->with('mensaje', 'Cuota pospuesta para el día siguiente con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
