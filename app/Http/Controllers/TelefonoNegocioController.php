<?php

namespace App\Http\Controllers;

use App\Models\TelNegocio;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class TelefonoNegocioController extends Controller
{
    /**
     * Show the form for creating the resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store the newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
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
              'id_tel_negocio' => $size,
              'tel_negocio' => $request->input('tel_negocio')
            ]
          );

          $request->session()->put('telefonos_negocio_temporal', $array);
        }else{
          $telefono_negocio = new TelNegocio();
          $telefono_negocio->id_negocio = $request->input('id_negocio');
          $telefono_negocio->tel_negocio = $request->input('tel_negocio');

          if($telefono_negocio->save()){
            $telefonos = TelNegocio::where('id_negocio', $request->input('id_negocio'))->get();
            return $telefonos;
          }else{
            return '';
          }
        }

      }else if($request->input('opcion') == 'eliminar'){
        if($request->input('session') == 'true') {
          $array = $request->session()->get('telefonos_negocio_temporal');
          $array = Arr::except($array, $request->input('id_tel_negocio'));
          $request->session()->put('telefonos_negocio_temporal', $array);
        }else{
          $telefono_negocio = TelNegocio::where('id_tel_negocio', $request->input('id_tel_negocio'))->delete();

          if($telefono_negocio){
            $telefonos = TelNegocio::where('id_negocio', $request->input('id_negocio'))->get();
            return $telefonos;
          }else{
            return '';
          }
        }
      }else if($request->input('opcion') == 'limpiar'){
        $request->session()->forget('telefonos_negocio_temporal');
      }

      return $request->session()->get('telefonos_negocio_temporal');
    }

    /**
     * Display the resource.
     *
     * @return Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the resource.
     *
     * @return Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function update(Request $request)
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
