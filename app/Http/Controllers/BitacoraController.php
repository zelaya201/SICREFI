<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bitacora;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BitacoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $usuarios = Usuario::all();

      return response(view('content.bitacora.index', compact('usuarios')));
    }

    public function buscar(Request $request){
      //$resultados = new Bitacora();

      $usuarios = Usuario::all();

      $fecha_inicio = Carbon::parse($request->fecha_desde);
      $fecha_fin = Carbon::parse($request->fecha_hasta);

      $resultados = Bitacora::query()
                              ->whereBetween('fecha_operacion_bitacora', [date($fecha_inicio), date($fecha_fin)])
                              ->where('tabla_operacion_bitacora', 'LIKE', $request->id_tabla.'%')
                              ->where('id_usuario', '=', $request->id_usuario)
                              ->orderBy('fecha_operacion_bitacora', 'asc')
                              ->get();



      $resultados->load('usuario');

      //dd($resultados);

      return response(view('content.bitacora.index', compact('resultados', 'usuarios')));
      //return response(view('content.bitacora.index'));
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
