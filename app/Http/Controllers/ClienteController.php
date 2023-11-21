<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\Cliente;
use App\Models\Conyuge;
use App\Models\Credito;
use App\Models\Cuota;
use App\Models\Negocio;
use App\Models\Referencia;
use App\Models\TelCliente;
use App\Models\TelConyuge;
use App\Models\TelNegocio;
use App\Models\TelReferencia;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    Session::forget('estado_filtro');
    Session::forget('mostrar');

    $query = Cliente::query();

    if ($request->input('estado') || $request->input('mostrar')) {
      $estado = $request->input('estado');
      $mostrar = $request->input('mostrar', 10);

      session(['estado_filtro' => $estado, 'mostrar' => $mostrar]);

      if ($estado == 'Todos') {
        $clientes = $query->orderBy('estado_cliente','ASC')->orderBy('primer_nom_cliente','ASC')->paginate($mostrar);
      }else {
        $clientes = $query->where(['estado_cliente' => $estado])->orderBy('primer_nom_cliente','ASC')->paginate($mostrar);
      }

      $clientes->map(function ($cliente) {
        $cliente->conyuge = false;

        $cliente->nom_completo = $cliente->primer_nom_cliente . ' '
          . $cliente->segundo_nom_cliente . ' '
          . $cliente->tercer_nom_cliente . ' '
          . $cliente->primer_ape_cliente . ' '
          . $cliente->segundo_ape_cliente;

        if($cliente->estado_civil_cliente == 'Casado') {
          $cliente->conyuge = true;
        }

        return $cliente;
      });

      $contar = count(Cliente::all());
      $activos = count(Cliente::query()->where(['estado_cliente' => 'Activo'])->get());
      $inactivos = count(Cliente::query()->where(['estado_cliente' => 'Inactivo'])->get());
      $clientes_creditos = count(Cliente::query()->where(['estado_cliente' => 'Activo'])->get());

      return response()->view(
        'content.clientes.index',
        [
          'clientes' => $clientes,
          'contar' => $contar,
          'activos' => $activos,
          'inactivos' => $inactivos,
          'clientes_creditos' => $clientes_creditos
        ]
      );
    }

    $clientes = $query->where(['estado_cliente' => 'Activo'])->orderBy('primer_nom_cliente','ASC')->paginate(10);
    $contar = count(Cliente::all());
    $activos = count(Cliente::query()->where(['estado_cliente' => 'Activo'])->get());
    $inactivos = count(Cliente::query()->where(['estado_cliente' => 'Inactivo'])->get());
    $clientes_creditos = count(Credito::query()->where(['estado_credito' => 'Vigente'])->get());

    $clientes->map(function ($cliente) {
      $cliente->nom_completo = $cliente->primer_nom_cliente . ' ' . $cliente->segundo_nom_cliente . ' ' . $cliente->tercer_nom_cliente . ' ' . $cliente->primer_ape_cliente . ' ' . $cliente->segundo_ape_cliente;
      $cliente->conyuge = false;

      if($cliente->estado_civil_cliente == 'Casado') {
        $cliente->conyuge = true;
      }

      return $cliente;
    });

    return response()->view(
      'content.clientes.index',
      [
        'clientes' => $clientes,
        'contar' => $contar,
        'activos' => $activos,
        'inactivos' => $inactivos,
        'clientes_creditos' => $clientes_creditos
      ]
    );
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    Session::forget('telefonos_clientes'); // Elimina todos los registros de la sesión de telefonos_clientes
    Session::forget('telefonos_conyuge'); // Elimina todos los registros de la sesión de telefonos_conyuge

    $cliente = new Cliente();

    return view('content.clientes.create', compact('cliente'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

    $request->validate(Cliente::$rules, Cliente::$messages);

    $array_telefonos_clientes = $request->session()->get('telefonos_clientes');
    $array_telefonos_conyuge = $request->session()->get('telefonos_conyuge');

    if(empty($array_telefonos_clientes)) {
      return ['success' => false, 'message' => 'Debe agregar al menos un teléfono del cliente', 'tab' => 'cliente'];
    }

    if($request->estado_civil_cliente == 'Casado') {
      $request->validate([
        'primer_nom_conyuge' => 'required:min:2|max:50|regex:/^[a-zA-Z0-9\s]+$/',
        'segundo_nom_conyuge' => 'nullable|min:2|max:50|regex:/^[a-zA-Z0-9\s]+$/',
        'tercer_nom_conyuge' => 'nullable|min:2|max:50|regex:/^[a-zA-Z0-9\s]+$/',
        'primer_ape_conyuge' => 'required:min:2|max:50|regex:/^[a-zA-Z0-9\s]+$/',
        'segundo_ape_conyuge' => 'nullable|min:2|max:50|regex:/^[a-zA-Z0-9\s]+$/',
        'ocupacion_conyuge' => 'required:min:3',
        'dir_conyuge' => 'required:min:3',
      ]);

      if(empty($array_telefonos_conyuge)) {
        return ['success' => false, 'message' => 'Debe agregar al menos un teléfono del conyuge', 'tab' => 'conyuge'];
      }
    }

    $cliente = new Cliente();
    $cliente->fill($request->all());
    $cliente->estado_cliente = 'Activo';

    if($cliente->save()) {
      $identificador = Cliente::latest('id_cliente')->first()->id_cliente;

      $array = $request->session()->get('telefonos_clientes');
      foreach ($array as $telefono) {
        $tel_cliente = new TelCliente();
        $tel_cliente->tel_cliente = $telefono['tel_cliente'];
        $tel_cliente->id_cliente = $identificador;
        $tel_cliente->save();
      }

      if($cliente->estado_civil_cliente == 'Casado') {
        $conyuge = new Conyuge();
        $conyuge->fill($request->all());
        $conyuge->id_cliente = $identificador;

        if($conyuge->save()) {
          $array = $request->session()->get('telefonos_conyuge');
          foreach ($array as $telefono) {
            $tel_conyuge = new TelConyuge();
            $tel_conyuge->tel_conyuge = $telefono['tel_conyuge'];
            $tel_conyuge->id_conyuge = Conyuge::latest('id_conyuge')->first()->id_conyuge;
            $tel_conyuge->save();
          }
        }
      }

      /* Mensaje Flash */
      Session::flash('success', '');
      Session::flash('mensaje', 'Cliente agregado con éxito');
      return ['success' => true];
    }

    return ['success' => false, 'message' => 'Error al agregar cliente', 'errors' => $cliente->errors()];
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    /* Mostrar información del cliente y su historial crediticio */

    $cliente = Cliente::query()->where(['id_cliente' => $id])->get()->first();
    $cliente->nombre_completo = $cliente->primer_nom_cliente . ' ' . $cliente->segundo_nom_cliente . ' ' . $cliente->tercer_nom_cliente . ' ' . $cliente->primer_ape_cliente . ' ' . $cliente->segundo_ape_cliente;
    $telefono = TelCliente::query()->select('tel_cliente')->where(['id_cliente' => $id])->get()->first();

    $cliente->tel_cliente = 'No encontrado.';

    if($telefono) {
      $cliente->tel_cliente = '+503 ' . $telefono->tel_cliente;
    }

    $creditos = Credito::query()->where(['id_cliente' => $id])->orderBy('id_credito', 'DESC')->get();
    $creditos = $creditos->map(function ($credito){
      $cuotas_mora = Cuota::query()
        ->where(['id_credito' => $credito->id_credito, 'estado_cuota' => 'Pendiente'])
        ->where('fecha_pago_cuota', '<', date('Y-m-d'))->get();

      $credito->cuotas_mora = 0;

      if (count($cuotas_mora)> 0) {
        $credito->estado_credito = 'Mora';
        $credito->cuotas_mora = count($cuotas_mora);
      }else{
        $cuotas_mora = Cuota::query()
          ->where(['id_credito' => $credito->id_credito, 'estado_cuota' => 'Atrasada'])->get();

        if (count($cuotas_mora)> 0) {
          $credito->estado_credito = 'Mora';
          $credito->cuotas_mora = count($cuotas_mora);
        }
      }

      return $credito;
    });

    $total_desembolsos = 0;
    $total_creditos = 0;
    $cuotas_mora = 0;
    $refinanciamientos = 0;

    if($creditos){
      foreach ($creditos as $credito){
        $total_desembolsos += $credito->desembolso_credito;

        if($credito->estado_credito == 'Refinanciado'){
          $refinanciamientos++;
        }

        $cuotas_mora += $credito->cuotas_mora;
      }

      $total_creditos = count($creditos);
    }

    return response()->view(
      'content.clientes.show',
      [
        'cliente' => $cliente,
        'creditos' => $creditos,
        'total_creditos' => $total_creditos,
        'total_desembolsos' => $total_desembolsos,
        'cuotas_mora' => $cuotas_mora,
        'refinanciamientos' => $refinanciamientos
      ]
    );
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit(int $id) {
    /* Modificar cliente */
    $cliente = Cliente::query()->where(['id_cliente' => $id])->get()->first();

    return view('content.clientes.edit', compact('cliente'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
      $request->validate([
        'dui_cliente' => 'required|numeric|digits:9|unique:cliente,dui_cliente,' . $id . ',id_cliente',
        'primer_nom_cliente' => 'required|min:2|max:50|alpha',
        'segundo_nom_cliente' => 'nullable|min:2|max:50|alpha',
        'tercer_nom_cliente' => 'nullable|min:2|max:50|alpha',
        'primer_ape_cliente' => 'required|min:2|max:50|alpha',
        'segundo_ape_cliente' => 'nullable|min:2|max:50|alpha',
        'fech_nac_cliente' => 'required|date',
        'ocupacion_cliente' => 'required|min:3',
        'tipo_vivienda_cliente' => 'required',
        'dir_cliente' => 'required',
        'gasto_aliment_cliente' => 'required|numeric',
        'gasto_agua_cliente' => 'required|numeric',
        'gasto_luz_cliente' => 'required|numeric',
        'gasto_cable_cliente' => 'required|numeric',
        'gasto_vivienda_cliente' => 'required|numeric',
        'gasto_otro_cliente' => 'required|numeric',
        'email_cliente' => 'required|email|unique:cliente,email_cliente,' . $id . ',id_cliente',
        'estado_civil_cliente' => 'required',
      ]);

      $cliente = Cliente::where(['id_cliente' => $id])->get()->first();
      $cliente->fill($request->all());

      if($cliente->save()) {
        /* Mensaje Flash */
        Session::flash('success', '');
        Session::flash('mensaje', 'Cliente modificado con éxito');
        return ['success' => true];
      }

      return ['success' => false, 'message' => 'Error al modificar cliente', 'errors' => $cliente->errors()];

//    $cliente = Cliente::query()->where(['id_cliente' => $id])->get()->first();
//    $cliente->fill(['estado_cliente' => 'Activo']);
//
//    if($cliente->save()) {
//      /* Mensaje Flash */
//      Session::flash('success', '');
//      Session::flash('mensaje', 'Cliente restaurado con éxito');
//
//      return ['success' => true];
//    }
//
//    return ['success' => false];
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $cliente = Cliente::query()->where(['id_cliente' => $id])->get()->first();

    $credito = Credito::query()->where(['id_cliente' => $id, 'estado_credito' => 'Vigente'])->get()->first();

    if($credito) {
      Session::flash('error', '');
      Session::flash('mensaje', 'No se puede eliminar el cliente porque tiene un crédito activo');
      return ['success' => true];
    }

    $cliente->fill(['estado_cliente' => 'Inactivo']);

    if($cliente->save()) {
      /* Mensaje Flash */
      Session::flash('success', '');
      Session::flash('mensaje', 'Cliente eliminado con éxito');

      return ['success' => true];
    }

    return ['success' => false];
  }
}
