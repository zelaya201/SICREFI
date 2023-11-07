<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Declaración Jurada - SICREFI</title>
  <style>

    body {
      font-family: 'Times New Roman', 'serif';
      font-size: 16px;
      text-align: justify;
      line-height: 1.5em;
      padding: 2.5em;
      border: 1px solid black;
    }

    footer {
      position: fixed;
      bottom: 0px;
      left: 0px;
      right: 0px;
      top: 85%;
      height: 50px;
      line-height: 1em;
      font-size: 14px;
    }

    li{
      list-style: none;
    }
  </style>
</head>
<body>
<h3 align="center">{{ $title }}</h3>
<p>
  Yo <i>{{ $cliente->nombre . ' ' . $cliente->apellido }}</i> con Documento Único de Identidad número {{ $cliente->dui_cliente }}
  entrego en pago a {{ $cooperativa->nom_coop }} de forma voluntaria los siguientes bienes muebles de mi propiedad:

  <ul>
    @foreach($bienes as $bien)
      <li>{{ $loop->iteration }}. {{ $bien->nom_bien }} {{ $bien->descrip_bien }} - Valor estimado: ${{ number_format($bien->valor_bien,2) }}</li>
    @endforeach
  </ul>

  El valor de estos bienes se abonaran al saldo del crédito número: {{ $credito->id_credito }}.

  <br>

    @php
      setlocale(LC_TIME, 'spanish');
      $fecha = strftime("%d dias del mes de %B del año %Y", strtotime(date('Y-m-d')));
    @endphp

    <strong>Responsabilidad del deudor: </strong>Yo, el deudor bajo juramento declaro que los bienes que son entregados
    en este acto, son de mi única y exclusiva propiedad, y se encuentran libres de gravamen, así mismo declaro exento
    de mi responsabilidad al acreedor o a cualquiera de sus empleados sobre la procedencia y propiedad de los bienes muebles
    entregados siendo de mi propiedad y única responsabilidad, inclusive penal, cualquier situación que derivada en la
    perturbación de la posesión de los bienes aquí entregados en pago. En fe de lo anterior firmo la presente declaración
    pago de bienes en la ciudad de San Vicente a los {{ $fecha }}.

  <br>
  <br>
  <br>

  Firma del deudor: _________________________________
</p>

<footer>
  <p align="center">
    <strong>Empresa unipersonal de Créditos</strong>
    <br>
    <strong>{{ $cooperativa->nom_coop }}</strong>
    <br>
    <strong>{{ $cooperativa->dir_coop }}</strong>
    <br>
    <strong>Teléfono: +503 {{ $cooperativa->tel_coop }}</strong>
  </p>
</footer>
</body>
</html>
