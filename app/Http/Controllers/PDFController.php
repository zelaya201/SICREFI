<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\Cliente;
use App\Models\Cooperativa;
use App\Models\Credito;
use App\Models\CreditoBien;
use App\Models\CreditoReferencia;
use App\Models\Referencia;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
class PDFController extends Controller
{

  protected $credito, $cliente;

    /**
     * Display a listing of the resource.
     *
     * @param int $id
     */
    public function __invoke(int $id): void
    {
      $this->credito = new Credito();
      $this->credito = Credito::query()
        ->where('id_credito', $id)->first();

      $this->cliente = new Cliente();
      $this->cliente = Cliente::query()
        ->where('id_cliente', $this->credito->id_cliente)->first();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @param int $id
     */
    public function generarDeclaracion(int $id)
    {

      $this->__invoke($id);
      $this->cliente->nombre = $this
          ->cliente
          ->primer_nom_cliente . ' ' . $this
          ->cliente->segundo_nom_cliente . ' ' . $this
          ->cliente->tercer_nom_cliente;
      $this->cliente->apellido = $this->cliente->primer_ape_cliente . ' ' . $this->cliente->segundo_ape_cliente;

      $bienes= CreditoBien::query()
        ->select('id_bien')
        ->where(['id_credito' => $id])
        ->get();

      $bienes = $bienes->map(function ($item) {
        $bien = Bien::query()
          ->where('id_bien', $item->id_bien)->first();

        $item->nom_bien = $bien->nom_bien;
        $item->descrip_bien = $bien->descrip_bien;
        $item->valor_bien = $bien->valor_bien;

        return $item;
      });

      $coperativa = Cooperativa::query()
        ->select('nom_coop', 'dir_coop', 'tel_coop')
        ->first();

      $data = [
        'title' => 'Declaración Jurada de Bienes Muebles',
        'date' => date('m/d/Y'),
        'cliente' => $this->cliente,
        'bienes' => $bienes,
        'credito' => $this->credito,
        'cooperativa' => $coperativa
      ];

      $pdf = PDF::loadView('content.pdf.declaracion', $data);
      $pdf->setPaper('letter');

      return $pdf->stream('declaracion.pdf');
    }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   * @param int $id
   */
    public function generarPagare(int $id){

      $this->__invoke($id);

      $this->cliente->nombre = $this
        ->cliente
        ->primer_nom_cliente . ' ' . $this
        ->cliente->segundo_nom_cliente . ' ' . $this
        ->cliente->tercer_nom_cliente;
      $this->cliente->apellido = $this->cliente->primer_ape_cliente . ' ' . $this->cliente->segundo_ape_cliente;

      $refCredito = CreditoReferencia::query()
        ->select('id_ref')
        ->where(['id_credito' => $id])
        ->get();

      $refCredito = $refCredito->map(function ($item) {
        $ref = Referencia::query()
          ->where('id_ref', $item->id_ref)->first();

        $item->nom_ref = $ref->primer_nom_ref . ' ' . $ref->segundo_nom_ref . ' ' . $ref->tercer_nom_ref;
        $item->ape_ref = $ref->primer_ape_ref . ' ' . $ref->segundo_ape_ref;

        return $item;
      });

      $data = [
        'title' => 'PAGARÉ',
        'date' => date('m/d/Y'),
        'cliente' => $this->cliente,
        'credito' => $this->credito,
        'referencias' => $refCredito
      ];

      $pdf = PDF::loadView('content.pdf.pagare', $data);
      $pdf->setPaper('letter');

      return $pdf->stream('pagare.pdf');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @param int $id
     */
    public function generarRecibo(int $id){

        $this->__invoke($id);

        $this->cliente->nombre = $this
          ->cliente
          ->primer_nom_cliente . ' ' . $this
          ->cliente->segundo_nom_cliente . ' ' . $this
          ->cliente->tercer_nom_cliente;
        $this->cliente->apellido = $this->cliente->primer_ape_cliente . ' ' . $this->cliente->segundo_ape_cliente;

        $this->credito->monto_credito = number_format($this->credito->monto_credito, 2, '.', ',');
        $this->credito->interes_credito = number_format($this->credito->interes_credito, 2, '.', ',');
        $this->credito->cuota_credito = number_format($this->credito->cuota_credito, 2, '.', ',');

        $data = [
          'title' => 'RECIBO DE PAGO',
          'date' => date('m/d/Y'),
          'cliente' => $this->cliente,
          'credito' => $this->credito
          ];

    }

}
