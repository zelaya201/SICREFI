<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

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
    $cliente->setTable('cliente');

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
    $cliente->estado_cliente = 'Activo';


    $cliente->save(); // INSERT INTO - SQL

    return to_route('clientes.index')->with('mensaje', 'Cliente agregado con éxito');
    //return $request->all();
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
    //
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
