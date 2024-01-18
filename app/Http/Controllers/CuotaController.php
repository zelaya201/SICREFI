<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Cliente;
use App\Models\Cooperativa;
use App\Models\Credito;
use App\Models\Cuota;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class CuotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(!session()->has('id_usuario')){
        return redirect()->route('login');
      }

      $cuotas_mora = Cuota::query()
        ->where(['estado_cuota' => 'Pendiente'])
        ->where('fecha_pago_cuota', '<', date('Y-m-d'))
        ->get();

      if(count($cuotas_mora) > 0) {
        foreach ($cuotas_mora as $cuota_mora) {
          $cuota_mora->estado_cuota = 'Atrasada';
          $cuota_mora->mora_cuota = 0.05 * $cuota_mora->total_cuota;
          $cuota_mora->save();

          $credito = Credito::query()->where('id_credito', $cuota_mora->id_credito)->first();
          $credito->estado_credito = 'En mora';
          $credito->save();
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
      if(!session()->has('id_usuario')){
        return redirect()->route('login');
      }

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

            $credito = Credito::query()->where('id_credito', $cuotaAPagar->id_credito)->first();
            $credito->estado_credito = 'En mora';
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

      $bitacora = new Bitacora();
      $bitacora->id_usuario = session()->get('id_usuario');
      $bitacora->tabla_operacion_bitacora = 'Cuota';
      $bitacora->operacion_bitacora = 'Se registró el pago de la cuota con id ' . $cuota->id_cuota . ' del crédito número ' . $cuota->id_credito . '';
      $bitacora->fecha_operacion_bitacora = date('Y-m-d');
      $bitacora->save();

      $cuotas = Cuota::query()->where('id_credito', $cuota->id_credito)
        ->where('estado_cuota', '!=', 'Pagada')
        ->get();

      $credito = Credito::query()->where('id_credito', $cuota->id_credito)->first();
      $credito->estado_credito = 'Vigente';
      $credito->save();

      if(count($cuotas) == 0) {
        $credito = Credito::query()->where('id_credito', $cuota->id_credito)->first();
        $credito->estado_credito = 'Finalizado';
        $credito->save();
      }

      $cuotas = Cuota::query()
        ->where(['id_credito' => $cuota->id_credito])
        ->get();

      // Datos
      foreach ($cuotas as $key => $value) {
        if ($value->id_cuota == $id) {
          $cuota->num_cuota = $key + 1;
        }
      }

      $credito = Credito::query()->where('id_credito', $cuota->id_credito)->first();
      $cliente = Cliente::query()->where('id_cliente', $credito->id_cliente)->first();
      $cooperativa = Cooperativa::query()->first();

      $nombre = $cliente->primer_nom_cliente . ' ' . $cliente->segundo_nom_cliente . ' ' . $cliente->tercer_nom_cliente;
      $apellido = $cliente->primer_ape_cliente . ' ' . $cliente->segundo_ape_cliente;

      $cliente->nombre = $nombre;
      $cliente->apellido = $apellido;

      // Crear PDF y enviarlo por correo
      $pdf = PDF::loadView('content.pdf.ticket', [
        'title' => 'COMPROBANTE DE PAGO',
        'date' => date('m/d/Y'),
        'cliente' => $cliente,
        'fecha' => strftime("%d de %B de %Y", strtotime(date('Y-m-d'))),
        'credito' => $credito,
        'cuota' => $cuota,
        'cooperativa' => $cooperativa
      ]);

      $pdf->setPaper(array(0,0,240,410));

      $headers = $pdf->output();

      $msg = '
        <html>
          <head>
            <title>Comprobante de pago - SICREFI</title>
          </head>
          <body>
            <p>Estimado(a) ' . $cliente->primer_nom_cliente . ' ' . $cliente->segundo_nom_cliente . ' ' . $cliente->tercer_nom_cliente . ' ' . $cliente->primer_ape_cliente . ' ' . $cliente->segundo_ape_cliente . ',</p>
            <p>Se ha realizado el pago de la cuota número ' . $cuota->num_cuota . ' del crédito número ' . $credito->id_credito . '.</p>
            <p>Adjunto encontrará el comprobante de pago.</p>
            <p>Gracias por confiar en nosotros.</p>
            <p>Atentamente,</p>
            <p>' . $cooperativa->nom_coop . '</p>
          </body>
        </html>
      ';

      $this->smtp_mailer(
        $cliente->email_cliente,
        'Comprobante de pago',
        $msg,
        $headers
      );

      return redirect()
        ->route('cuotas.edit', $cuota->id_credito)
        ->with('success', 'La cuota ha sido pagada con éxito');
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

      $bitacora = new Bitacora();
      $bitacora->id_usuario = session()->get('id_usuario');
      $bitacora->tabla_operacion_bitacora = 'Credito';
      $bitacora->operacion_bitacora = 'Se registró el pago del crédito número ' . $credito->id_credito . '';
      $bitacora->fecha_operacion_bitacora = date('Y-m-d');
      $bitacora->save();

      return redirect()
        ->route('creditos.index', $credito->id_credito)
        ->with('success', 'El crédito ha sido pagado con éxito');
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

      $bitacora = new Bitacora();
      $bitacora->id_usuario = session()->get('id_usuario');
      $bitacora->tabla_operacion_bitacora = 'Cuota';
      $bitacora->operacion_bitacora = 'Se registró el pago de la cuota con id ' . $cuota->id_cuota . ' del crédito número ' . $cuota->id_credito . '';
      $bitacora->fecha_operacion_bitacora = date('Y-m-d');
      $bitacora->save();

      $credito = Credito::query()->where('id_credito', $cuota->id_credito)->first();
      $credito->estado_credito = 'Vigente';
      $credito->save();

      $cuotas = Cuota::query()->where('id_credito', $cuota->id_credito)
        ->where('estado_cuota', '!=', 'Pagada')
        ->get();

      if(count($cuotas) == 0) {
        $credito = Credito::query()->where('id_credito', $cuota->id_credito)->first();
        $credito->estado_credito = 'Finalizado';
        $credito->save();
      }

      $cuotas = Cuota::query()
        ->where(['id_credito' => $cuota->id_credito])
        ->get();

      // Datos
      foreach ($cuotas as $key => $value) {
        if ($value->id_cuota == $id) {
          $cuota->num_cuota = $key + 1;
        }
      }

      $credito = Credito::query()->where('id_credito', $cuota->id_credito)->first();
      $cliente = Cliente::query()->where('id_cliente', $credito->id_cliente)->first();
      $cooperativa = Cooperativa::query()->first();

      $nombre = $cliente->primer_nom_cliente . ' ' . $cliente->segundo_nom_cliente . ' ' . $cliente->tercer_nom_cliente;
      $apellido = $cliente->primer_ape_cliente . ' ' . $cliente->segundo_ape_cliente;

      $cliente->nombre = $nombre;
      $cliente->apellido = $apellido;

      // Crear PDF y enviarlo por correo
      $pdf = PDF::loadView('content.pdf.ticket', [
        'title' => 'COMPROBANTE DE PAGO',
        'date' => date('m/d/Y'),
        'cliente' => $cliente,
        'fecha' => strftime("%d de %B de %Y", strtotime(date('Y-m-d'))),
        'credito' => $credito,
        'cuota' => $cuota,
        'cooperativa' => $cooperativa
      ]);

      $pdf->setPaper(array(0,0,240,410));

      $headers = $pdf->output();

      $msg = '
        <html>
          <head>
            <title>Comprobante de pago - SICREFI</title>
          </head>
          <body>
            <p>Estimado(a) ' . $cliente->primer_nom_cliente . ' ' . $cliente->segundo_nom_cliente . ' ' . $cliente->tercer_nom_cliente . ' ' . $cliente->primer_ape_cliente . ' ' . $cliente->segundo_ape_cliente . ',</p>
            <p>Se ha realizado el pago de la cuota número ' . $cuota->num_cuota . ' del crédito número ' . $credito->id_credito . '.</p>
            <p>Adjunto encontrará el comprobante de pago.</p>
            <p>Gracias por confiar en nosotros.</p>
            <p>Atentamente,</p>
            <p>' . $cooperativa->nom_coop . '</p>
          </body>
        </html>
      ';

      $this->smtp_mailer(
        $cliente->email_cliente,
        'Comprobante de pago',
        $msg,
        $headers
      );

      return redirect()
        ->route('cuotas.index', $cuota->id_credito)
        ->with('success', 'La cuota ha sido pagada con éxito');
    }

  /**
   * Posponer cuota de un crédito
   * @param int $id
   * @return \Illuminate\Http\Response
   * @throws \Exception
   */

    public function posponerCuota($id){
      $cuota = Cuota::query()->where('id_cuota', $id)->first();
      $date =  new DateTime($cuota->fecha_pago_cuota);

      $cuota->fecha_pago_cuota = date('Y-m-d', strtotime($cuota->fecha_pago_cuota . ' + 1 day'));

      if($date->format('N') == 6) {
        $cuota->fecha_pago_cuota = date('Y-m-d', strtotime($cuota->fecha_pago_cuota . ' + 2 day'));
      }

      $fechaFormateada = date('d-m-Y', strtotime($cuota->fecha_pago_cuota));

      if($cuota->save()){
        return redirect()
          ->route('cuotas.index', $cuota->id_credito)
          ->with('success', 'La cuota ha sido pospuesta con éxito a la fecha ' . $fechaFormateada);
      }

      return redirect()
        ->route('cuotas.index', $cuota->id_credito)
        ->with('error', 'La cuota no ha sido pospuesta con éxito');
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

  function smtp_mailer($to, $subject, $msg, $headers)
  {
    $mail = new PHPMailer(true);

    try {
      //Server settings
      $mail->SMTPDebug = 0;                      // Enable verbose debug output
      $mail->isSMTP();                                            // Send using SMTP
      $mail->Host = env('MAIL_HOST');                    // Set the SMTP server to send through
      $mail->SMTPSecure = 'TLS';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
      $mail->CharSet = 'UTF-8';
      $mail->IsHTML(true);
      $mail->SMTPAuth = true;                                   // Enable SMTP authentication
      $mail->Username = env('MAIL_USERNAME');                     // SMTP username
      $mail->Password = env('MAIL_PASSWORD');                               // SMTP password
      $mail->Port = 587;                                    // TCP port to connect to

      //Recipients
      $mail->setFrom('support@sicrefisv.tech', 'SICREFI');
      $mail->addAddress($to);     // Add a recipient

      $mail->addStringAttachment($headers, 'comprobante.pdf');

      // Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = $subject;
      $mail->Body = $msg;


      $mail->send();
      return 'Sent';
    } catch (Exception $e) {
      return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  }
}
