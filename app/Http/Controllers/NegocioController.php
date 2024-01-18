<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\Cliente;
use App\Models\Credito;
use App\Models\Negocio;
use App\Models\TelNegocio;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class NegocioController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return Response
   */
  public function store(Request $request)
  {

    if($request->input('opcion') == 'agregar'){
      $request->validate([
        'nom_negocio' => 'required',
        'tiempo_negocio' => 'required',
        'dir_negocio' => 'required',
        'buena_venta_negocio' => 'required|numeric',
        'mala_venta_negocio' => 'required|numeric',
        'ganancia_diaria_negocio' => 'required|numeric',
        'inversion_diaria_negocio' => 'required|numeric',
        'gasto_emp_negocio' => 'required|numeric',
        'gasto_alquiler_negocio' => 'required|numeric',
        'gasto_impuesto_negocio' => 'required|numeric',
        'gasto_credito_negocio' => 'required|numeric',
        'gasto_otro_negocio' => 'required|numeric'
      ]);

      // Si es vacio el array de telefonos
      if(empty($request->session()->get('telefonos_negocio_temporal'))){
        return ['success' => false, 'message' => 'Debe agregar al menos un teléfono'];
      }

      if($request->input('session') == 'true') {

        $size = 1;
        $array = $request->session()->get('negocios');

        if ($request->session()->has('negocios')) {
          end($array);
          $size = key($array) + 1;

          /* Verificar si el negocio existe en los session */
          foreach ($array as $negocio) {
            if($negocio['nom_negocio'] == $request->input('nom_negocio')){
              return ['success' => false, 'message' => 'El negocio ya existe', 'input' => 'nom_negocio'];
            }
          }
        }

        $array = Arr::add($array,
          $size,
          [
            'id' => $size,
            'nom_negocio' => $request->input('nom_negocio'),
            'tiempo_negocio' => $request->input('tiempo_negocio'),
            'dir_negocio' => $request->input('dir_negocio'),
            'buena_venta_negocio' => $request->input('buena_venta_negocio'),
            'mala_venta_negocio' => $request->input('mala_venta_negocio'),
            'ganancia_diaria_negocio' => $request->input('ganancia_diaria_negocio'),
            'inversion_diaria_negocio' => $request->input('inversion_diaria_negocio'),
            'gasto_emp_negocio' => $request->input('gasto_emp_negocio'),
            'gasto_alquiler_negocio' => $request->input('gasto_alquiler_negocio'),
            'gasto_impuesto_negocio' => $request->input('gasto_impuesto_negocio'),
            'gasto_credito_negocio' => $request->input('gasto_credito_negocio'),
            'gasto_otro_negocio' => $request->input('gasto_otro_negocio'),
            'telefonos_negocio' => $request->session()->get('telefonos_negocio_temporal')
          ]
        );

        $request->session()->forget('telefonos_negocio_temporal');
        $request->session()->put('negocios', $array);
      }else{

        /* Verificar si el negocio existe en la base de datos */
        $negocios = Negocio::where('id_cliente', $request->input('id_cliente'))->get();


        foreach ($negocios as $negocio) {
          if($negocio->nom_negocio == $request->input('nom_negocio')){
            return ['success' => false, 'message' => 'El negocio ya existe', 'input' => 'nom_negocio'];
          }
        }


        /* Agregar Negocio a Base de Datos */
        $negocio = new Negocio();
        $negocio->fill($request->input());
        $negocio->estado_negocio = 'Activo';

        if($negocio->save()){

          $bitacora = new Bitacora();
          $bitacora->id_usuario = session()->get('id_usuario');
          $bitacora->tabla_operacion_bitacora = 'Negocio';
          $bitacora->operacion_bitacora = 'Se inserto el registro ' . $negocio->id_negocio . ' en la tabla negocios';
          $bitacora->save();

          $tel_negocios = $request->session()->get('telefonos_negocio_temporal');

          foreach ($tel_negocios as $telefono) {
            $tel = new TelNegocio();
            $tel->tel_negocio = $telefono['tel_negocio'];
            $tel->id_negocio = Negocio::latest('id_negocio')->first()->id_negocio;
            $tel->save();

            $bitacora = new Bitacora();
            $bitacora->id_usuario = session()->get('id_usuario');
            $bitacora->tabla_operacion_bitacora = 'TelNegocio';
            $bitacora->operacion_bitacora = 'Se inserto el registro ' . $tel->id_tel_negocio . ' en la tabla tel_negocios';
            $bitacora->fecha_operacion_bitacora = date('Y-m-d');
            $bitacora->save();
          }

          $request->session()->forget('telefonos_negocio_temporal');
          $request->session()->flash('success', true);
          $request->session()->flash('mensaje', 'Negocio agregado correctamente');
          return ['success' => true];
        }

      }

    }else if($request->input('opcion') == 'eliminar'){
      if($request->input('session') == 'true') {
        $array = $request->session()->get('negocios');
        $array = Arr::except($array, $request->input('id'));
        $request->session()->put('negocios', $array);
      }else{
        /* Eliminar Negocio de Base de Datos */
        $negocio = Negocio::findOrfail($request->input('id_negocio'));

        $credito = Credito::query()
          ->where('id_negocio', $negocio->id_negocio)
          ->where('estado_credito', 'Vigente')->first();

        if($credito){
          session()->flash('error');
          session()->flash(
            'mensaje',
            'No se puede eliminar el negocio porque esta asociado al crédito #' . $credito->id_credito
          );

          return ['success' => false];
        }

        $negocio->estado_negocio = 'Inactivo';

        if($negocio->save()) {

          $bitacora = new Bitacora();
          $bitacora->id_usuario = session()->get('id_usuario');
          $bitacora->tabla_operacion_bitacora = 'Negocio';
          $bitacora->operacion_bitacora = 'Se dio de baja el registro ' . $negocio->id_negocio . ' en la tabla negocios';
          $bitacora->fecha_operacion_bitacora = date('Y-m-d');
          $bitacora->save();

          $request->session()->flash('success');
          $request->session()->flash('mensaje', 'Negocio eliminado correctamente');
          return ['success' => true, 'message' => 'Negocio eliminado correctamente'];
        }
      }
    }else if($request->input('opcion') == 'obtener'){
      if($request->input('session') == 'true') {
        $request->session()->forget('telefonos_negocio_temporal');
        $array = $request->session()->get('negocios');

        $request->session()->put(
          'telefonos_negocio_temporal',
          $array[$request->input('id')]['telefonos_negocio']
        );

        return Arr::get($array, $request->input('id'));
      }
    }else if($request->input('opcion') == 'actualizar') {
      $request->validate([
        'nom_negocio' => 'required',
        'tiempo_negocio' => 'required',
        'dir_negocio' => 'required',
        'buena_venta_negocio' => 'required|numeric',
        'mala_venta_negocio' => 'required|numeric',
        'ganancia_diaria_negocio' => 'required|numeric',
        'inversion_diaria_negocio' => 'required|numeric',
        'gasto_emp_negocio' => 'required|numeric',
        'gasto_alquiler_negocio' => 'required|numeric',
        'gasto_impuesto_negocio' => 'required|numeric',
        'gasto_credito_negocio' => 'required|numeric',
        'gasto_otro_negocio' => 'required|numeric'
      ]);

      if ($request->input('session') == 'true') {
        // Si es vacio el array de telefonos
        if(empty($request->session()->get('telefonos_negocio_temporal'))){
          return ['success' => false, 'message' => 'Debe agregar al menos un teléfono'];
        }

        $array = $request->session()->get('negocios');

        /* Verificar si el negocio existe en los session */
        foreach ($array as $negocio) {
          if($negocio['nom_negocio'] == $request->input('nom_negocio') && $negocio['id'] != $request->input('id')){
            return ['success' => false, 'message' => 'El negocio ya existe', 'input' => 'nom_negocio'];
          }
        }

        /* Actualizar elemento del array session */
        $array[$request->input('id')] = [
          'id' => $request->input('id'),
          'nom_negocio' => $request->input('nom_negocio'),
          'tiempo_negocio' => $request->input('tiempo_negocio'),
          'dir_negocio' => $request->input('dir_negocio'),
          'buena_venta_negocio' => $request->input('buena_venta_negocio'),
          'mala_venta_negocio' => $request->input('mala_venta_negocio'),
          'ganancia_diaria_negocio' => $request->input('ganancia_diaria_negocio'),
          'inversion_diaria_negocio' => $request->input('inversion_diaria_negocio'),
          'gasto_emp_negocio' => $request->input('gasto_emp_negocio'),
          'gasto_alquiler_negocio' => $request->input('gasto_alquiler_negocio'),
          'gasto_impuesto_negocio' => $request->input('gasto_impuesto_negocio'),
          'gasto_credito_negocio' => $request->input('gasto_credito_negocio'),
          'gasto_otro_negocio' => $request->input('gasto_otro_negocio'),
          'telefonos_negocio' => $request->session()->get('telefonos_negocio_temporal')
        ];

        $request->session()->forget('telefonos_negocio_temporal');
        $request->session()->put('negocios', $array);
      }else{
        /* Actualizar Negocio de Base de Datos */
        $negocio = Negocio::findOrfail($request->input('id_negocio'));

        $negocio->fill($request->input());

        if($negocio->save()) {
          $bitacora = new Bitacora();
          $bitacora->id_usuario = session()->get('id_usuario');
          $bitacora->tabla_operacion_bitacora = 'Negocio';
          $bitacora->operacion_bitacora = 'Se actualizo el registro ' . $negocio->id_negocio . ' en la tabla negocios';
          $bitacora->fecha_operacion_bitacora = date('Y-m-d');
          $bitacora->save();

          $request->session()->flash('success');
          $request->session()->flash('mensaje', 'Negocio actualizado correctamente');
          return ['success' => true];

        }
      }
    }else if($request->input('opcion') == 'darAlta') {
      $negocio = Negocio::findOrfail($request->input('id_negocio'));
      $negocio->estado_negocio = 'Activo';

      if($negocio->save()) {

        $bitacora = new Bitacora();
        $bitacora->id_usuario = session()->get('id_usuario');
        $bitacora->tabla_operacion_bitacora = 'Negocio';
        $bitacora->operacion_bitacora = 'Se dio de alta el registro ' . $negocio->id_negocio . ' en la tabla negocios';
        $bitacora->fecha_operacion_bitacora = date('Y-m-d');
        $bitacora->save();

        $request->session()->flash('success');
        $request->session()->flash('mensaje', 'Negocio restaurado correctamente');
        return ['success' => true];
      }
    }

    return $request->session()->get('negocios');
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return Response
   */
  public function show($id)
  {
    if(!session()->has('id_usuario')){
      return redirect()->route('login');
    }

    $negocios = Negocio::where('id_cliente', $id)->get();
    $cliente = Cliente::where('id_cliente', $id)->first();
    return view('content.clientes.negocios.index', ['cliente' => $cliente], compact('negocios'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return Response
   */
  public function edit($id)
  {
      $negocio = Negocio::where('id_negocio', $id)->first();
      $tel_negocio = TelNegocio::where('id_negocio', $id)->get();

      return ['negocio' => $negocio, 'tel_negocio' => $tel_negocio];
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return Response
   */
  public function destroy($id)
  {

  }

}
