<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class NegocioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->session()->forget('negocios');
        $size = 0;

        if($request->session()->has('negocios')) {
          $size = count($request->session()->get('negocios'));
        }

        $array = $request->session()->get('negocios');
        $array = Arr::add($array,
          $size,
          [
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
            'gasto_otro_negocio' => $request->input('gasto_otro_negocio')
          ]
        );

        $request->session()->put('negocios', $array);

      return $request->session()->get('negocios');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
