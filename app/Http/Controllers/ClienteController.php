<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\Cliente;
use App\Models\Conyuge;
use App\Models\Negocio;
use App\Models\Referencia;
use App\Models\TelCliente;
use App\Models\TelConyuge;
use App\Models\TelNegocio;
use App\Models\TelReferencia;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

class ClienteController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $query = Cliente::query();

    if ($request->ajax()) {
      if (empty($request->estado) || $request->estado == 'Todos') {
        $clientes = $query->orderBy('primer_nom_cliente','ASC')->get();
      }else {
        $clientes = $query->where(['estado_cliente' => $request->estado])->orderBy('primer_nom_cliente','ASC')->get();
      }

      return response()->json(['clientes' => $clientes]);
    }

    $clientes = $query->where(['estado_cliente' => 'Activo'])->orderBy('primer_nom_cliente','ASC')->get();

    return view('content.clientes.index', compact('clientes'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    Session::forget('negocios'); // Elimina todos los registros de la sesión de negocios
    Session::forget('referencias'); // Elimina todos los registros de la sesión de referencias
    Session::forget('bienes'); // Elimina todos los registros de la sesión de bienes
    Session::forget('telefonos_clientes'); // Elimina todos los registros de la sesión de telefonos_clientes
    Session::forget('telefonos_conyuge'); // Elimina todos los registros de la sesión de telefonos_conyuge
    Session::forget('telefonos_negocio_temporal'); // Elimina todos los registros de la sesión de telefonos_negocio_temporal
    Session::forget('telefonos_referencia_temporal'); // Elimina todos los registros de la sesión de telefonos_referencia_temporal

    return view('content.clientes.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

    $request->validate([
      'dui_cliente' => 'required|unique:cliente|numeric',
      'primer_nom_cliente' => 'required|min:2|max:50',
      'primer_ape_cliente' => 'required|min:2|max:50',
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
      'email_cliente' => 'required|unique:cliente|email',
    ]);

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

      //if($cliente->estado_civil_cliente == 'Casado') {
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
      //}

      $array = $request->session()->get('negocios');

      foreach ($array as $negocio) {
        $neg = new Negocio();
        $neg->fill($negocio);
        $neg->estado_negocio = 'Activo';
        $neg->id_cliente = $identificador;

        if($neg->save()){
          $tel_negocios = $negocio['telefonos_negocio'];
          foreach ($tel_negocios as $telefono) {
            $tel = new TelNegocio();
            $tel->tel_negocio = $telefono['tel_negocio'];
            $tel->id_negocio = Negocio::latest('id_negocio')->first()->id_negocio;
            $tel->save();
          }
        }
      }

      $array = $request->session()->get('referencias');

      foreach ($array as $referencia) {
        $ref = new Referencia();
        $ref->fill($referencia);
        $ref->estado_ref = 'Activo';

        $ref->id_cliente = $identificador;

        if($ref->save()) {
          $tel_referencias = $referencia['telefonos_ref'];
          foreach ($tel_referencias as $telefono) {
            $tel = new TelReferencia();
            $tel->tel_ref = $telefono['tel_ref'];
            $tel->id_ref = Referencia::latest('id_ref')->first()->id_ref;
            $tel->save();
          }
        }
      }

      $array = $request->session()->get('bienes');

      foreach ($array as $bien) {
        $b = new Bien();
        $b->nom_bien = $bien['nom_bien'];
        $b->estado_bien = 'Activo';
        $b->id_cliente = $identificador;
        $b->save();
      }

      return ['success' => true, 'message' => 'Cliente agregado con éxito'];

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
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {

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
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
