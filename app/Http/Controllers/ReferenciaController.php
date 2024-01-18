<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Credito;
use App\Models\Referencia;
use App\Models\TelReferencia;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class ReferenciaController extends Controller
{
    /**
     * Show the form for creating the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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

        $request->validate([
          'primer_nom_ref' => 'required|alpha|min:2|max:50',
          'segundo_nom_ref' => 'nullable|alpha|min:2|max:50',
          'tercer_nom_ref' => 'nullable|alpha|min:2|max:50',
          'primer_ape_ref' => 'required|alpha|min:2|max:50',
          'segundo_ape_ref' => 'nullable|alpha|min:2|max:50',
          'dir_ref' => 'required',
          'ocupacion_ref' => 'required',
          'parentesco_ref' => 'required'
        ]);

        // Si es vacio el array de telefonos
        if(empty($request->session()->get('telefonos_referencia_temporal'))){
          return [
            'success' => false,
            'message' => 'Debe agregar al menos un teléfono'
          ];
        }

        if($request->input('session') == 'true') {
          $size = 1;
          $array = $request->session()->get('referencias');

          if ($request->session()->has('referencias')) {
            end($array);
            $size = key($array) + 1;
          }

          $array = Arr::add($array,
            $size,
            [
              'id' => $size,
              'primer_nom_ref' => $request->input('primer_nom_ref'),
              'segundo_nom_ref' => $request->input('segundo_nom_ref'),
              'tercer_nom_ref' => $request->input('tercer_nom_ref'),
              'primer_ape_ref' => $request->input('primer_ape_ref'),
              'segundo_ape_ref' => $request->input('segundo_ape_ref'),
              'dir_ref' => $request->input('dir_ref'),
              'ocupacion_ref' => $request->input('ocupacion_ref'),
              'parentesco_ref' => $request->input('parentesco_ref'),
              'telefonos_ref' => $request->session()->get('telefonos_referencia_temporal')
            ]
          );

          $request->session()->forget('telefonos_referencia_temporal');
          $request->session()->put('referencias', $array);
        }else{
          $referencia = new Referencia();
          $referencia->fill($request->all());
          $referencia->estado_ref = 'Activo';
          $referencia->save();

          $telefonos = $request->session()->get('telefonos_referencia_temporal');

          foreach ($telefonos as $telefono) {
            $tel = new TelReferencia();
            $tel->tel_ref = $telefono['tel_ref'];
            $tel->id_ref = Referencia::latest('id_ref')->first()->id_ref;
            $tel->save();
          }

          $request->session()->forget('telefonos_referencia_temporal');

          $request->session()->flash('success');
          $request->session()->flash('mensaje', 'Referencia agregada correctamente');

          return [
            'success' => true,
            'message' => 'Referencia agregada correctamente'
          ];
        }

      }else if($request->input('opcion') == 'eliminar'){
        if($request->input('session') == 'true') {
          $array = $request->session()->get('referencias');
          $array = Arr::except($array, $request->input('id'));
          $request->session()->put('referencias', $array);
        }else{
          /* Eliminar Negocio de Base de Datos */
          $referencia = Referencia::findOrfail($request->input('id_ref'));

          $credito = Credito::query()
            ->join('credito_referencia', 'credito_referencia.id_credito', '=', 'credito.id_credito')
            ->where('credito_referencia.id_ref', $referencia->id_ref)
             ->where('estado_credito', 'Vigente')->first();

          if($credito){
            $request->session()->flash('error');
            $request->session()->flash(
              'mensaje',
              'No se puede eliminar la referencia porque esta asociado al crédito #' . $credito->id_credito
            );

            return ['success' => false];
          }

          $referencia->estado_ref = 'Inactivo';

          if($referencia->save()) {
            $request->session()->flash('success');
            $request->session()->flash('mensaje', 'Referencia eliminada correctamente');
            return ['success' => true, 'message' => 'Referencia eliminada correctamente'];
          }
        }
      }else if($request->input('opcion') == 'obtener'){
        if($request->input('session') == 'true') {

          $request->session()->forget('telefonos_referencia_temporal');
          $array = $request->session()->get('referencias');

          $request->session()->put(
            'telefonos_referencia_temporal',
            $array[$request->input('id')]['telefonos_ref']
          );

          return Arr::get($array, $request->input('id'));
        }else{
          $referencia = Referencia::where('id_ref', $request->input('id_ref'))->first();
          $tel_ref = TelReferencia::where('id_ref', $request->input('id_ref'))->get();

          return ['ref' => $referencia, 'tel_ref' => $tel_ref];
        }
      }else if($request->input('opcion') == 'actualizar') {

        $request->validate([
          'primer_nom_ref' => 'required|alpha|min:2|max:50',
          'segundo_nom_ref' => 'nullable|alpha|min:2|max:50',
          'tercer_nom_ref' => 'nullable|alpha|min:2|max:50',
          'primer_ape_ref' => 'required|alpha|min:2|max:50',
          'segundo_ape_ref' => 'nullable|alpha|min:2|max:50',
          'dir_ref' => 'required',
          'ocupacion_ref' => 'required',
          'parentesco_ref' => 'required'
        ]);

        if ($request->input('session') == 'true') {

          // Si es vacio el array de telefonos
          if(empty($request->session()->get('telefonos_referencia_temporal'))){
            return [
              'success' => false,
              'message' => 'Debe agregar al menos un teléfono'
            ];
          }

          $array = $request->session()->get('referencias');
          /* Actualizar elemento del array session */
          $array[$request->input('id')] = [
            'id' => $request->input('id'),
            'primer_nom_ref' => $request->input('primer_nom_ref'),
            'segundo_nom_ref' => $request->input('segundo_nom_ref'),
            'tercer_nom_ref' => $request->input('tercer_nom_ref'),
            'primer_ape_ref' => $request->input('primer_ape_ref'),
            'segundo_ape_ref' => $request->input('segundo_ape_ref'),
            'dir_ref' => $request->input('dir_ref'),
            'ocupacion_ref' => $request->input('ocupacion_ref'),
            'parentesco_ref' => $request->input('parentesco_ref'),
            'telefonos_ref' => $request->session()->get('telefonos_referencia_temporal')
          ];

          $request->session()->forget('telefonos_referencia_temporal');
          $request->session()->put('referencias', $array);
        }else{
          $referencia = Referencia::where('id_ref', $request->input('id_ref'))->first();
          $referencia->fill($request->all());

          if($referencia->save()){
            $request->session()->flash('success');
            $request->session()->flash('mensaje', 'Referencia actualizada correctamente');

            return [
              'success' => true,
              'message' => 'Referencia actualizada correctamente'
            ];
          }
        }
      }else if($request->input('opcion') == 'darAlta') {
        $referencia = Referencia::findOrfail($request->input('id_ref'));
        $referencia->estado_ref = 'Activo';

        if($referencia->save()) {
          $request->session()->flash('success');
          $request->session()->flash('mensaje', 'Referencia restaurada correctamente');
          return ['success' => true];
        }
      }

      return $request->session()->get('referencias');
    }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return Response
   */
    public function show($id)
    {
      if(!session()->has('id_usuario')){
        return redirect()->route('login');
      }

      $referencias = Referencia::where('id_cliente', $id)->get();
      $cliente = Cliente::where('id_cliente', $id)->first();
      return view('content.clientes.referencias.index', ['cliente' => $cliente], compact('referencias'));
    }

    /**
     * Show the form for editing the resource.
     *
     * @return \Illuminate\Http\Response
     * @param int $id
     */
    public function edit($id)
    {
      $referencia = Referencia::where('id_ref', $id)->first();
      $tel_ref = TelReferencia::where('id_ref', $id)->get();

      return ['ref' => $referencia, 'tel_ref' => $tel_ref];
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

    }
}
