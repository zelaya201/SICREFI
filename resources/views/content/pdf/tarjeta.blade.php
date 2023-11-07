<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Tarjeta de Control - SICREFI</title>
  <style>
    body {
      font-family: 'Helvetica', 'serif';
      font-size: 13px;
      text-align: justify;
      line-height: 1.2em;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      text-align: left;
    }

    .table {
      border-collapse: collapse;
      width: 100%;
      text-align: center;
    }

    .table tr td, .table tr th {
      border: 1px solid #ddd;
    }
  </style>
</head>
<body>

<header>
  <h3 align="center">{{ $title }}</h3>
  <table>
    <tr>
      <td><strong>Nombre del Cliente:</strong></td>
      <td>{{ $cliente->nombre . ' ' . $cliente->apellido }}</td>
      <td><strong>N° de Crédito:</strong></td>
      <td>{{ $credito->id_credito }}</td>
    </tr>
    <tr>
      <td><strong>Monto:</strong></td>
      <td>${{ number_format($credito->monto_neto_credito,2) }}</td>
      <td><strong>N° de Cuotas:</strong></td>
      <td>
        @if($credito->frecuencia_credito == 'Diario')
          {{ $credito->n_cuotas_credito }} Días
        @elseif($credito->frecuencia_credito == 'Semanal')
          {{ $credito->n_cuotas_credito }} Semanas
        @elseif($credito->frecuencia_credito == 'Quincenal')
          {{ $credito->n_cuotas_credito }} Quincenas
        @elseif($credito->frecuencia_credito == 'Mensual')
          {{ $credito->n_cuotas_credito }} Meses
        @endif
      </td>
    </tr>
    <tr>
      <td><strong>Fecha inicio:</strong></td>
      <td>{{ strftime("%d-%m-%Y", strtotime($credito->fecha_emision_credito)) }}</td>
      <td><strong>Fecha de Vencimiento:</strong></td>
      <td>{{ strftime("%d-%m-%Y", strtotime($credito->fecha_vencimiento_credito)) }}</td>
    <tr>
      <td><strong>Oficial de Crédito:</strong></td>
      <td>{{ $cooperativa->nom_coop }}</td>
      <td><strong>Teléfono:</strong></td>
      <td>+503 {{ $cooperativa->tel_coop }}</td>
    </tr>
  </table>
</header>
<br>
<section>
  <table class="table">
    <thead>
      <tr>
        <th>Cuota</th>
        <th>Fecha</th>
        <th>Valor cuota</th>
        <th>Cuota</th>
        <th>Fecha</th>
        <th>Valor cuota</th>
      </tr>
    </thead>
    <tbody>
      @if(count($cuotas) > 40)
        @php
          $mitad = count($cuotas) / 2;
        @endphp

        @for($i = 0; $i < $mitad; $i++)
          <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ strftime("%d-%m-%Y", strtotime($cuotas[$i]->fecha_pago_cuota)) }}</td>
            <td>${{ number_format($cuotas[$i]->total_cuota,2) }}</td>
            <td>{{ ($i+1)+$mitad }}</td>
            <td>{{ strftime("%d-%m-%Y", strtotime($cuotas[$i + $mitad]->fecha_pago_cuota)) }}</td>
            <td>${{ number_format($cuotas[$i + $mitad]->total_cuota,2) }}</td>
          </tr>
        @endfor
      @else
        @foreach($cuotas as $cuota)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ strftime("%d-%m-%Y", strtotime($cuota->fecha_pago_cuota)) }}</td>
            <td>${{ number_format($cuota->total_cuota,2) }}</td>
          </tr>
        @endforeach
      @endif
    </tbody>
  </table>
</section>

<footer>
  <p style="font-size: 14px;"><b><i><u>Recuerda</u></i></b></p>
  <p style="font-size: 13px; line-height: 0.1;"><i>Es TU resposabilidad estar pendiente de las fechas y horarios de pago de las cuotas.</i></p>
  <p style="font-size: 13px; line-height: 0.1;"><i>El impago de las cuotas generara intereses moratorios del 5% adicional.</i></p>
  <p style="font-size: 13px; line-height: 0.1;"><i>El impago de las cuotas genera reportes de mal record crediticio en los buros crediticios.</i></p>
  <p style="font-size: 13px; line-height: 0.1;"><i>De tu puntualidad depende el apoyo crediticio de nuestra institución en el futuro. </i></p>
</footer>

</body>
