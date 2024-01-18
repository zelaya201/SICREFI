<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bitacora;
use App\Models\Cooperativa;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(!session()->has('id_usuario')){
        return redirect()->route('login');
      }

        $cooperativa = Cooperativa::all()->first();

        return response(view('content.configuracion.index', compact('cooperativa')));
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
        //
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
        $request->validate(Cooperativa::$rules, Cooperativa::$messages);

        $cooperativa = Cooperativa::find($id);

        $cooperativa->fill($request->all());

        if ($cooperativa->save()) {

          // Bitacora
          $bitacora = new Bitacora();
          $bitacora->id_usuario = session()->get('id_usuario');
          $bitacora->tabla_operacion_bitacora = 'Cooperativa';
          $bitacora->operacion_bitacora = 'Se actualizó la configuración de la cooperativa';
          $bitacora->fecha_operacion_bitacora = date('Y-m-d');
          $bitacora->save();

          $request->session()->flash('success', 'La configuración se ha actualizado correctamente.');
            return ['success' => true];
        }

        return ['success' => false];
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
