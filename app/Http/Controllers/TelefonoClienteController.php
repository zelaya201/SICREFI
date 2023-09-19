<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\TelCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TelefonoClienteController extends Controller
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
          $array = $request->session()->get('telefonos_clientes');

          if ($request->session()->has('telefonos_clientes')) {
            end($array);
            $size = key($array) + 1;

            // Verificar si el telefono ya existe
            foreach ($array as $key => $value) {
              if($value['tel_cliente'] == $request->input('tel_cliente')){
                return [
                  'success' => false, 'message' => 'El teléfono ya existe'
                ];
              }
            }
          }

          $array = Arr::add($array,
            $size,
            [
              'id' => $size,
              'tel_cliente' => $request->input('tel_cliente')
            ]
          );

          $request->session()->put('telefonos_clientes', $array);
        }

      }else if($request->input('opcion') == 'eliminar'){
        if($request->input('session') == 'true') {
          $array = $request->session()->get('telefonos_clientes');
          $array = Arr::except($array, $request->input('id'));
          $request->session()->put('telefonos_clientes', $array);
        }
      }

      return $request->session()->get('telefonos_clientes');
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
    public function edit(Request $request, $id)
    {
      $cliente = Cliente::query()->where(['id_cliente' => $id])->get()->first();

      $telefono = new TelCliente();
      $telefono->tel_cliente = $request->input('tel');
      $telefono->id_cliente = $cliente->id_cliente;
      $telefono->save();

      return ['success' => true];
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
     * Remove the resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $telefono = TelCliente::query()->where(['id_tel_cliente' => $id])->get()->first();
      $telefono->delete();

      return ['success' => true];
    }
}
