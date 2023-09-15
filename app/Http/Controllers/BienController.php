<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class BienController extends Controller
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
          $array = $request->session()->get('bienes');

          if ($request->session()->has('bienes')) {
            end($array);
            $size = key($array) + 1;
          }

          $array = Arr::add($array,
            $size,
            [
              'id' => $size,
              'nom_bien' => $request->input('nom_bien')
            ]
          );

          $request->session()->put('bienes', $array);
        }

      }else if($request->input('opcion') == 'eliminar'){
        if($request->input('session') == 'true') {
          $array = $request->session()->get('bienes');
          $array = Arr::except($array, $request->input('id'));
          $request->session()->put('bienes', $array);
        }
      }else if($request->input('opcion') == 'obtener'){
        if($request->input('session') == 'true') {
          $array = $request->session()->get('bienes');
          return Arr::get($array, $request->input('id'));
        }
      }else if($request->input('opcion') == 'actualizar') {
        if ($request->input('session') == 'true') {
          $array = $request->session()->get('bienes');
          /* Actualizar elemento del array session */
          $array[$request->input('id')] = [
            'id' => $request->input('id'),
            'nom_bien' => $request->input('nom_bien')
          ];

          $request->session()->put('bienes', $array);
        }
      }

      return $request->session()->get('bienes');
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
