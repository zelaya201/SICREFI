<?php

namespace App\Http\Controllers;

use App\Models\TelNegocio;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TelefonoNegocioController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if($request->input('opcion') == 'agregar'){
        if($request->input('session') == 'true') {
          $size = 1;
          $array = $request->session()->get('telefonos_negocio_temporal');

          if ($request->session()->has('telefonos_negocio_temporal')) {
            end($array);
            $size = key($array) + 1;
          }

          $array = Arr::add($array,
            $size,
            [
              'id' => $size,
              'tel_negocio' => $request->input('tel_negocio')
            ]
          );

          $request->session()->put('telefonos_negocio_temporal', $array);
        }

      }else if($request->input('opcion') == 'eliminar'){
        if($request->input('session') == 'true') {
          $array = $request->session()->get('telefonos_negocio_temporal');
          $array = Arr::except($array, $request->input('id'));
          $request->session()->put('telefonos_negocio_temporal', $array);
        }
      }else if($request->input('opcion') == 'limpiar'){
        $request->session()->forget('telefonos_negocio_temporal');
      }

      return $request->session()->get('telefonos_negocio_temporal');
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
        //
    }

    /**
     * Update the resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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
    $tel_negocio = TelNegocio::where('id_tel_negocio', $id)->first();
    $tel_negocio->delete();

    //$telefonos = TelNegocio::where('id_negocio', $tel_negocio->id_negocio)->all();

    return ['success' => true, 'message' => 'Teléfono eliminado con éxito'];
  }
}
