<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ticket - SICREFI</title>
  <style>
    body {
      font-family: 'Helvetica', 'serif';
      font-size: 12px;
      text-align: justify;
      line-height: 1.5em;
      padding: 2.5em;
    }
  </style>
</head>
<body>

  <header>
    <h3 align="center">{{ $title }}</h3>
  </header>

  <p align="center">____________________________________</p>
  <table>
    <tr>
      <td><strong>Nombre del Cliente:</strong></td>
      <td>{{ $cliente->nombre . ' ' . $cliente->apellido }}</td>
    </tr>
    <tr>
      <td><strong>Monto:</strong></td>
      <td>${{ number_format($credito->monto_neto_credito,2) }}</td>
    </tr>
    <tr>
      <td><strong>N° de Cuotas:</strong></td>
      <td>
        {{ $credito->n_cuotas_credito}}
      </td>
    </tr>
    <tr>
      <td><strong>Fecha:</strong></td>
      <td>{{ $fecha }}</td>
    <tr>
      <td><strong>Interés:</strong></td>
      <td>{{ $credito->tasa_interes_credito }}%</td>
    </tr>
    <tr>
      <td><strong>Valor de Cuota:</strong></td>
      <td>${{ number_format($credito->cuota_credito,2) }}</td>
    </tr>
    <tr>
      <td><strong>Saldo a descontar:</strong></td>
      <td>${{ number_format($saldodescontar = $credito->monto_neto_credito - $credito->desembolso_credito,2) }}</td>
    </tr>
    <tr>
      <td><strong>Desembolso:</strong></td>
      <td>${{ number_format($credito->desembolso_credito,2) }}</td>
    </tr>
  </table>
  <p align="center">____________________________________</p>


</body>
