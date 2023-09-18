<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TelefonoConyugeController extends Controller
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
          $array = $request->session()->get('telefonos_conyuge');

          if ($request->session()->has('telefonos_conyuge')) {
            end($array);
            $size = key($array) + 1;
          }

          $array = Arr::add($array,
            $size,
            [
              'id' => $size,
              'tel_conyuge' => $request->input('tel_conyuge')
            ]
          );

          $request->session()->put('telefonos_conyuge', $array);
        }

      }else if($request->input('opcion') == 'eliminar'){
        if($request->input('session') == 'true') {
          $array = $request->session()->get('telefonos_conyuge');
          $array = Arr::except($array, $request->input('id'));
          $request->session()->put('telefonos_conyuge', $array);
        }
      }

      return $request->session()->get('telefonos_conyuge');
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
     * Remove the resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        abort(404);
    }
}
