<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Recibo - SICREFI</title>
  <style>
    body {
      font-family: 'Times New Roman', 'serif';
      font-size: 18px;
      text-align: justify;
      line-height: 1.5em;
      padding: 2.5em;
    }
  </style>
</head>
<body>

  <header>
    San Vicente, {{ $fecha }}
  </header>

   <p >Recibí de:<b> Juana Dinora Barahona Quezada</b>, la cantidad de: <strong>${{ number_format($credito->monto_neto_credito,2) }}</strong> de los Estados Unidos de América
     en concepto de otorgamiento de un crédito, el cual pagaré en <strong> {{$credito->n_cuotas_credito}} </strong> cuotas de <strong>${{ number_format($credito->cuota_credito,2) }}</strong>  de forma
     constante y sucesivamente de lunes a viernes contadas a partir de ésta fecha.</p>

  <p style="line-height: 2;">Detalle:</p>
  <p style="line-height: 0.2;">Monto del crédito: <strong>${{ number_format($credito->monto_neto_credito,2) }}</strong></p>
  <p style="line-height: 0.2;">Saldo a descontar: <strong>${{ number_format($saldodescontar = $credito->monto_neto_credito - $credito->desembolso_credito,2) }}</strong> <br></p>
  <p style="line-height: 0.2;">Desembolso: <strong>${{ number_format($credito->desembolso_credito,2) }}</strong> <br></p>

 <p style="line-height: 3.5;">Firma: _______________________ </p>
  <p style="line-height: 0.2;"> Nombre: <strong>{{ $cliente->nombre . ' ' . $cliente->apellido }}</strong> <br> </p>
  <p style="line-height: 0.2;">DUI: <strong>{{ $cliente->dui_cliente }}</strong> <br></p>
</body>
