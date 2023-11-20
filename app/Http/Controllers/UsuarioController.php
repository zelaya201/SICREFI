<?php

namespace App\Http\Controllers;

use App\Models\Credito;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      Session::forget('estado_filtro');
      Session::forget('mostrar');

      $query = Usuario::query();

      if ($request->input('estado') || $request->input('mostrar')) {
        $estado = $request->input('estado');
        $mostrar = $request->input('mostrar', 10);

        session(['estado_filtro' => $estado, 'mostrar' => $mostrar]);

        if ($estado == 'Todos') {
          $usuarios = $query->orderBy('nick_usuario', 'ASC');
        }else {
          $usuarios = $query
            ->where(['estado_usuario' => $estado])
            ->orderBy('nick_usuario', 'ASC');
        }

        $usuarios->limit($mostrar)->get()->load('rol');

        return response(view('content.usuarios.index', compact('usuarios')));
      }

      $usuarios = Usuario::query()
        ->where(['estado_usuario' => 'Activo'])
        ->orderBy('nick_usuario', 'ASC')
        ->get()
        ->load('rol');

      return response(view('content.usuarios.index', compact('usuarios')));
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


  public function buscarUsuario(Request $request)
  {
    $output = '';
    $contador = 1;
    $usuarios = DB::table('usuarios')
      ->where('usuarios.nom_usuario', 'LIKE', '%' . $request->search . '%')
      ->orWhere('usuarios.nick_usuario', 'LIKE', '%' . $request->search . '%')
      ->orWhere('usuarios.email_usuario', 'LIKE', '%' . $request->search . '%')
      ->orWhere('usuarios.estado_usuario', 'LIKE', '%' . $request->search . '%')
      ->get();


    if ($usuarios->isEmpty()) {
      $output = '<tr style="text-align: center;">' .
        '<td colspan="8">No se encontraron resultados</td>' .
        '</tr>';
    }else {
      $usuarios->load('rol');
      foreach ($usuarios as $usuario) {

        $output .= '<tr>' .
          '<td>' . $contador . '</td>' .
          '<td>' . $usuario->nom_usuario . '</td>' .
          '<td>' . $usuario->nick_usuario . '</td>' .
          '<td>' . $usuario->email_usuario . '</td>' .
          '<td>' . $usuario->rol->nom_rol . '</td>';

        if ($usuario->estado_usuario == 'Vigente') {
          $output .= '<td><span class="badge rounded-pill bg-label-success">Activo</span></td>';
        } else if ($usuario->estado_usuario == 'En mora') {
          $output .= '<td><span class="badge rounded-pill bg-label-danger">Inactivo</span></td>';
        }

        $output .=
          '<td>
            <div class="dropdown-icon-demo">
              <a href="javascript:void(0);" class="btn dropdown-toggle btn-sm hide-arrow"
                 data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bx bx-dots-vertical-rounded"></i>
              </a>
            <div class="dropdown-menu">';

        if ($usuario->estado_credito == 'Inactivo') {
          $output .=
            'Inactivo';
        } else {
          $output .=
            '';
        }

        $output.= '</div>
                          </div>
                        </td>
                      </tr>';

        $contador++;
      }
    }
    return response($output);
  }

}
