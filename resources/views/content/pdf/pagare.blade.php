<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Pagaré - SICREFI</title>
  <style>
    body {
      font-family: 'Times New Roman', 'serif';
      font-size: 16px;
      text-align: justify;
      line-height: 1.5em;
      padding: 2.5em;
      border: 1px solid black;
    }

    header {
      text-align: right;
      font-size: 14px;
    }

    .danger{
      color: red;
    }
  </style>
</head>
<body>
  <header>
    <span class="danger">N° {{ $credito->id_credito }}</span>
  </header>

  <h3 align="center">{{ $title }} <br> SIN PROTESTO <br> POR $ <u>{{ number_format($credito->monto_neto_credito, 2) }}</u></h3>
  @php
    setlocale(LC_TIME, 'spanish');
    $fecha_principal = strftime("%d del mes de %B del año dos mil %y", strtotime(date('Y-m-d')));
    $fecha_secundaria = strftime("%d dias del mes de %B del año %Y", strtotime(date('Y-m-d')));

    $refs = '';
  @endphp

  @foreach($referencias as $referencia)
    @php
      $refs .= $referencia->nom_ref . ' ' . $referencia->ape_ref;
    @endphp

    @if(!$loop->last)
      @php
        $refs .= ', ';
      @endphp
    @endif
  @endforeach

  <p>
    Por el presente PAGARÉ YO, <u>{{ $cliente->nombre . ' ' . $cliente->apellido }}</u>
    conocido por; {{ $refs }} me obligo a pagar
    incondicionalmente a la orden de Juana Dinora Barahona Quezada, del domicilio de San
    Vicente, con Documento Único de Identidad número cero dos tres cero dos tres cuatro nueve
    – uno y Número de Identificación Tributaria número Mil diez- doscientos treinta un mil ochenta
    y dos – ciento dos - seis el día {{ $fecha_principal }} en su domicilio situado en la ciudad de San Vicente en la Republica de
    El Salvador, la cantidad de {{ number_format($credito->monto_neto_credito, 2) }} <strong> <u> DÓLARES DE LOS ESTADOS UNIDOS
      DE AMÉRICA</u></strong> , obligándome a pagar sobre esta deuda y a partir de esta fecha, el interés nominal
    de {{ number_format($credito->tasa_interes_credito, 4) }} por ciento {{ $credito->frecuencia_credito }}, calculados a partir de la emisión de este Título Valor. Si
    el capital y los intereses convencionales antes indicados no fueren cancelados en la fecha de
    vencimiento de éste Pagaré, reconoceré el interés moratorio del cinco por ciento {{ $credito->frecuencia_credito }} sobre
    saldos vencidos. Para todos los efectos judiciales y extrajudiciales del presente Pagaré, las
    variaciones del interés se probaran plena y fehacientemente con la constancia extendida por
    mi contador. Fijo como domicilio especial el de esta ciudad, a cuyos tribunales me someto,
    siendo a mi cargo cualquier gasto que Juana Dinora Barahona Quezada, hiciere en el cobro de
    esta obligación, inclusive los llamados personales aun cuando no fuere condenado en costas.
    Faculto a Juana Dinora Barahona Quezada, hiciere en el cobro de esta obligación, inclusive los
    llamados personales aun cuando no fuere condenado en costas. Faculto a Juana Dinora
    Barahona Quezada para que designe a la persona depositaria de los bienes que se embarguen,
    a quien relevo de la obligación de rendir fianza para ejercer su cargo. San Vicente,
    departamento de San Vicente a los {{ $fecha_secundaria }}.


    <br><br><br><br>
    ________________________________ <br>
    Firma del Suscriptor <br>
    Nombre: <u>{{ $cliente->nombre . ' ' . $cliente->apellido }}</u> <br>
    Conocido por: <u>{{ $refs }}</u> <br>
    Profesión u oficio: <u>{{ $cliente->ocupacion_cliente }}</u> <br>
    DUI: <u>{{ $cliente->dui_cliente }}</u> <br>
    Domicilio Actual: <u>{{ $cliente->dir_cliente }}</u> <br>
  </p>

</body>
</html>
