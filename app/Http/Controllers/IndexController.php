<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Credito;
use App\Models\Cuota;
use App\Models\Usuario;
use Illuminate\Http\Request;

class IndexController extends Controller
{
  public function index()
  {

    // Obtener clientes registrados por mes en el año actual

    $clientes = Cliente::selectRaw('count(*) as total, MONTH(created_at) as mes')
      ->whereYear('created_at', date('Y'))
      ->groupBy('mes')
      ->get();

    $creditos = Credito::selectRaw('count(*) as total, MONTH(created_at) as mes')
      ->whereYear('created_at', date('Y'))
      ->groupBy('mes')
      ->get();

    // Cantidad de cobros del dia
    $cobros = Cuota::whereDate('fecha_pago_cuota', date('Y-m-d'))->count();

    // Cantidad de usuarios
    $usuarios = Usuario::count();

    $montoCartera = Credito::where('estado_credito', 'Vigente')->sum('monto_neto_credito');

    return response(view('content.index', [
      'clientes' => $clientes,
      'creditos' => $creditos,
      'usuarios' => $usuarios,
      'cobros' => $cobros,
      'montoCartera' => $montoCartera
    ]));
  }
}
