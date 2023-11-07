<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Comprobante - SICREFI</title>
  <style>
    body {
      font-family: 'Helvetica', 'serif';
      font-size: 12px;
      text-align: justify;
      line-height: 1.5em;
    }

    table {
      width: 100%;
      border-collapse: collapse;
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
      <td><strong>N° de Crédito:</strong></td>
      <td>{{ $credito->id_credito }}</td>
    </tr>
    <tr>
      <td><strong>DUI:</strong></td>
      <td>{{ $cliente->dui_cliente }}</td>
    </tr>
    <tr>
      <td><strong>Cliente:</strong></td>
      <td>{{ $cliente->nombre . ' ' . $cliente->apellido }}</td>
    </tr>
    <tr>
      <td><strong>(+) Monto:</strong></td>
      <td>${{ number_format($cuota->total_cuota, 2) }}</td>
    </tr>
    <tr>
      <td><strong>(+) Mora:</strong></td>
      <td>${{ number_format($cuota->mora_cuota, 2) }}</td>
    </tr>
    <tr>
      <td><strong>(=) Total:</strong></td>
      <td>${{ number_format(($cuota->total_cuota + $cuota->mora_cuota), 2) }}</td>
    </tr>
    <tr>
      <td><strong>Cuota:</strong></td>
      <td>{{ $cuota->num_cuota }}</td>
    </tr>
    <tr>
      <td><strong>Fecha:</strong></td>
      <td>{{ date('d-m-Y', strtotime($cuota->fecha_abono_cuota)) }}</td>
    </tr>

    <tr>
      <td><strong>Estado:</strong></td>
      <td>{{ $cuota->estado_cuota }}</td>
    </tr>
  </table>
  <p align="center">____________________________________</p>

  <br><br> <br>
  <p align="center">
    <i>
      Fecha de generación: <br>{{ date('d/m/Y H:i:s') }}
    </i>
  </p>

</body>
