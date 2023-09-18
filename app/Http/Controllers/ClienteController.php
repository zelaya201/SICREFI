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
  public function index()
  {
    $clientes = Cliente::all();

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

    $cliente->dui_cliente = $request->input('dui_cliente');
    $cliente->primer_nom_cliente = $request->input('primer_nom_cliente');
    $cliente->segundo_nom_cliente = $request->input('segundo_nom_cliente');
    $cliente->tercer_nom_cliente = $request->input('tercer_nom_cliente');
    $cliente->primer_ape_cliente = $request->input('primer_ape_cliente');
    $cliente->segundo_ape_cliente = $request->input('segundo_ape_cliente');
    $cliente->fech_nac_cliente = $request->input('fech_nac_cliente');
    $cliente->dir_cliente = $request->input('dir_cliente');
    $cliente->email_cliente = $request->input('email_cliente');
    $cliente->tipo_vivienda_cliente = $request->input('tipo_vivienda_cliente');
    $cliente->ocupacion_cliente = $request->input('ocupacion_cliente');
    $cliente->gasto_aliment_cliente = $request->input('gasto_aliment_cliente');
    $cliente->gasto_agua_cliente = $request->input('gasto_agua_cliente');
    $cliente->gasto_luz_cliente = $request->input('gasto_luz_cliente');
    $cliente->gasto_cable_cliente = $request->input('gasto_cable_cliente');
    $cliente->gasto_vivienda_cliente = $request->input('gasto_vivienda_cliente');
    $cliente->gasto_otro_cliente = $request->input('gasto_otro_cliente');
    $cliente->estado_civil_cliente = $request->input('estado_civil_cliente');
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
        $conyuge->primer_nom_conyuge = $request->input('primer_nom_conyuge');
        $conyuge->segundo_nom_conyuge = $request->input('segundo_nom_conyuge');
        $conyuge->tercer_nom_conyuge = $request->input('tercer_nom_conyuge');
        $conyuge->primer_ape_conyuge = $request->input('primer_ape_conyuge');
        $conyuge->segundo_ape_conyuge = $request->input('segundo_ape_conyuge');
        $conyuge->dir_conyuge = $request->input('dir_conyuge');
        $conyuge->ocupacion_conyuge = $request->input('ocupacion_conyuge');
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
        $neg->nom_negocio = $negocio['nom_negocio'];
        $neg->tiempo_negocio = $negocio['tiempo_negocio'];
        $neg->dir_negocio = $negocio['dir_negocio'];
        $neg->tiempo_negocio = $negocio['tiempo_negocio'];
        $neg->buena_venta_negocio = $negocio['buena_venta_negocio'];
        $neg->mala_venta_negocio = $negocio['mala_venta_negocio'];
        $neg->ganancia_diaria_negocio = $negocio['ganancia_diaria_negocio'];
        $neg->inversion_diaria_negocio= $negocio['inversion_diaria_negocio'];
        $neg->gasto_emp_negocio = $negocio['gasto_emp_negocio'];
        $neg->gasto_alquiler_negocio = $negocio['gasto_alquiler_negocio'];
        $neg->gasto_impuesto_negocio = $negocio['gasto_impuesto_negocio'];
        $neg->gasto_otro_negocio = $negocio['gasto_otro_negocio'];
        $neg->gasto_credito_negocio = $negocio['gasto_credito_negocio'];

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
        $ref->primer_nom_ref = $referencia['primer_nom_ref'];
        $ref->segundo_nom_ref = $referencia['segundo_nom_ref'];
        $ref->tercer_nom_ref = $referencia['tercer_nom_ref'];
        $ref->primer_ape_ref = $referencia['primer_ape_ref'];
        $ref->segundo_ape_ref = $referencia['segundo_ape_ref'];
        $ref->dir_ref = $referencia['dir_ref'];
        $ref->ocupacion_ref = $referencia['ocupacion_ref'];
        $ref->parentesco_ref = $referencia['parentesco_ref'];

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
