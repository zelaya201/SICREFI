<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Conyuge;
use App\Models\TelConyuge;
use Illuminate\Http\Request;

class ConyugeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
      $this->validate($request, Conyuge::$rules, Conyuge::$messages);

      $conyuge = Conyuge::query()->updateOrCreate(
        ['id_cliente' => $request->id_cliente],
        [
          'primer_nom_conyuge' => $request->primer_nom_conyuge,
          'segundo_nom_conyuge' => $request->segundo_nom_conyuge,
          'tercer_nom_conyuge' => $request->tercer_nom_conyuge,
          'primer_ape_conyuge' => $request->primer_ape_conyuge,
          'segundo_ape_conyuge' => $request->segundo_ape_conyuge,
          'ocupacion_conyuge' => $request->ocupacion_conyuge,
          'dir_conyuge' => $request->dir_conyuge,
          'id_cliente' => $request->id_cliente,
        ]
      );

      if($conyuge){
        $request->session()->flash('success', '');
        $request->session()->flash('message', 'Cónyuge modificado correctamente.');
        return response(['success' => true]);
      }

      return response(['success' => false]);
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
        $conyuge = Conyuge::query()->where('id_cliente', $id)->first();
        $telefonos = null;

        if($conyuge) {
          $telefonos = TelConyuge::query()->where('id_conyuge', $conyuge->id_conyuge)->get();
        }

        $existe = false;

        if($conyuge == null){
            $conyuge = new Conyuge();
            $existe = true;
        }

        $cliente = Cliente::query()->select('id_cliente','dui_cliente', 'primer_nom_cliente', 'primer_ape_cliente')
          ->where('id_cliente', $id)
          ->first();

        return response()->view(
          'content.clientes.conyuge.index',
          [
            'conyuge' => $conyuge,
            'cliente' => $cliente,
            'existe' => $existe,
            'telefonos' => $telefonos
          ]
        );
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
