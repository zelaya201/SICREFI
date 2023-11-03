<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\Cliente;
use App\Models\Credito;
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

            // Verificar si existe el bien existe en session
            foreach ($array as $negocio) {
              if($negocio['nom_bien'] == $request->input('nom_bien')){
                return ['success' => false, 'message' => 'El bien mueble ya existe', 'input' => 'nom_bien'];
              }
            }

          }

          $array = Arr::add($array,
            $size,
            [
              'id' => $size,
              'nom_bien' => $request->input('nom_bien'),
              'descrip_bien' => $request->input('descrip_bien'),
              'valor_bien' => $request->input('valor_bien')
            ]
          );

          $request->session()->put('bienes', $array);
        }else{
          // Validación por si ya existe el bien perteneciente al cliente
          $bien = Bien::where('id_cliente', $request->input('id_cliente'))
            ->where('nom_bien', $request->input('nom_bien'))
            ->first();

          if($bien){
            return ['success' => false, 'message' => 'El bien mueble ya existe.'];
          }

          // Guardar bien en base de datos
          $bien = new Bien();
          $bien->fill($request->all());
          $bien->estado_bien = 'Activo';
          if($bien->save()){
            $request->session()->flash('success');
            $request->session()->flash('mensaje', 'Bien mueble agregado correctamente.');
            return ['success' => true];
          }
        }

      }else if($request->input('opcion') == 'eliminar'){
        if($request->input('session') == 'true') {
          $array = $request->session()->get('bienes');
          $array = Arr::except($array, $request->input('id'));
          $request->session()->put('bienes', $array);
        }else{
          // Eliminar bien en base de datos
          $bien = Bien::where('id_bien', $request->input('id'))->first();

          $credito = Credito::query()
            ->join('credito_bien', 'credito_bien.id_credito', '=', 'credito.id_credito')
            ->where('credito_bien.id_bien', $bien->id_bien)
            ->where(['estado_credito' => 'Vigente'])->first();

          if($credito){
            $request->session()->flash('error');
            $request->session()->flash(
              'mensaje',
              'El bien mueble no puede darse de baja porque está asociado al crédito #' . $credito->id_credito);
            return ['success' => false];
          }

          $bien->estado_bien = 'Inactivo';
          if($bien->save()){
            $request->session()->flash('success');
            $request->session()->flash('mensaje', 'Bien mueble dado de baja correctamente.');
            return ['success' => true];
          }
        }
      }else if($request->input('opcion') == 'obtener'){
        if($request->input('session') == 'true') {
          $array = $request->session()->get('bienes');
          return Arr::get($array, $request->input('id'));
        }else{
          // Obtener bien en base de datos
          $bien = Bien::where('id_bien', $request->input('id_bien'))->first();
          return $bien;
        }
      }else if($request->input('opcion') == 'actualizar') {
        if ($request->input('session') == 'true') {
          $array = $request->session()->get('bienes');

          // Verificar si existe el bien existe en session
          foreach ($array as $negocio) {
            if($negocio['nom_bien'] == $request->input('nom_bien') && $negocio['id'] != $request->input('id')){
              return ['success' => false, 'message' => 'El bien mueble ya existe.', 'input' => 'nom_bien'];
            }
          }

          /* Actualizar elemento del array session */
          $array[$request->input('id')] = [
            'id' => $request->input('id'),
            'nom_bien' => $request->input('nom_bien'),
            'descrip_bien' => $request->input('descrip_bien'),
            'valor_bien' => $request->input('valor_bien')
          ];

          $request->session()->put('bienes', $array);
        }else{
          // Validación por si ya existe el bien perteneciente al cliente


          // Actualizar bien en base de datos
          $bien = Bien::where('id_bien', $request->input('id_bien'))->first();
          $bien->fill($request->all());
          if($bien->save()){
            $request->session()->flash('success');
            $request->session()->flash('mensaje', 'Bien mueble actualizado correctamente.');
            return ['success' => true];
          }
        }
      }else if($request->input('opcion') == 'darAlta') {
        $bien = Bien::findOrfail($request->input('id_bien'));
        $bien->estado_bien = 'Activo';

        if($bien->save()) {
          $request->session()->flash('success');
          $request->session()->flash('mensaje', 'Bien mueble restaurado correctamente');
          return ['success' => true];
        }
      }

      return $request->session()->get('bienes');
    }

    /**
     * Display the resource.
     *
     * @return \Illuminate\Http\Response
     * @param  int  $id
     */
    public function show($id)
    {
      $bienes = Bien::where('id_cliente', $id)->get();
      $cliente = Cliente::where('id_cliente', $id)->first();
      return view('content.clientes.bienes.index', ['cliente' => $cliente], compact('bienes'));
    }

    /**
     * Show the form for editing the resource.
     *
     * @return \Illuminate\Http\Response
     * @param int $id
     */
    public function edit(int $id)
    {
      $bien = Bien::where('id_bien', $id)->first();
      return ['bien' => $bien];
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

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function get($id)
  {
    $bienes = Bien::query()->where(['id_cliente' => $id])->get();
    return response($bienes);
  }
}
