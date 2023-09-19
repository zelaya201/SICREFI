<?php

namespace App\Http\Controllers;

use App\Models\TelReferencia;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TelefonoReferenciaController extends Controller
{
  /**
   * Show the form for creating the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    abort(404);
  }

  /**
   * Store the newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

    if ($request->input('opcion') == 'agregar') {
      if ($request->input('session') == 'true') {
        $size = 1;
        $array = $request->session()->get('telefonos_referencia_temporal');

        if ($request->session()->has('telefonos_referencia_temporal')) {
          end($array);
          $size = key($array) + 1;
        }

        $array = Arr::add($array,
          $size,
          [
            'id_tel_ref' => $size,
            'tel_ref' => $request->input('tel_ref')
          ]
        );

        $request->session()->put('telefonos_referencia_temporal', $array);
      } else {
        // Guardar en la base de datos
        $tel_referencia = new TelReferencia();
        $tel_referencia->tel_ref = $request->input('tel_ref');
        $tel_referencia->id_ref = $request->input('id_ref');

        if ($tel_referencia->save()) {
          $tel_referencia = TelReferencia::where('id_ref', $request->input('id_ref'))->get();
          return $tel_referencia;
        } else {
          return ['success' => false, 'message' => 'Error al agregar el teléfono de referencia'];
        }
      }

    } else if ($request->input('opcion') == 'eliminar') {
      if ($request->input('session') == 'true') {
        $array = $request->session()->get('telefonos_referencia_temporal');
        $array = Arr::except($array, $request->input('id_tel_ref'));
        $request->session()->put('telefonos_referencia_temporal', $array);
      } else {
        // Eliminar en la base de datos
        $telefonos = TelReferencia::where('id_ref', $request->input('id_ref'))->get();

        if(count($telefonos) == 1){
          return ['success' => false, 'message' => 'No se pueden eliminar todos los teléfonos, debe haber al menos uno.'];
        }

        $telefono_negocio = TelReferencia::where('id_tel_ref', $request->input('id_tel_ref'))->delete();

        if($telefono_negocio){
          $telefonos = TelReferencia::where('id_ref', $request->input('id_ref'))->get();
          return $telefonos;
        }else{
          return '';
        }
      }
    } else if ($request->input('opcion') == 'limpiar') {
      $request->session()->forget('telefonos_referencia_temporal');
    }

    return $request->session()->get('telefonos_referencia_temporal');
  }

  /**
   * Display the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function show()
  {
    //
  }

  /**
   * Show the form for editing the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function edit()
  {

  }

  /**
   * Update the resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {
    //
  }

  /**
   * Remove the resource from storage.
   *
   * @return \Illuminate\Http\Response
   */
  public function destroy()
  {
    abort(404);
  }
}
