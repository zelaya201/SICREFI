<?php

namespace App\Http\Controllers;

use App\Models\Credito;
use App\Models\Rol;
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

    $usuarios = Usuario::query()
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

    $roles = Rol::all();
    $usuario = new Usuario();

    return response(view('content.usuarios.create', compact('roles', 'usuario')));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $request->validate(Usuario::$rules, Usuario::$messages);

    $usuario = new Usuario();
    $usuario->fill($request->all());
    $clave = $this->generarClave(); // Genera una clave aleatoria

    $usuario->clave_usuario = md5($clave);
    $usuario->estado_usuario = 'Activo';

    if ($usuario->save()) {
      return ['success' => true];
    }

    return ['success' => false];
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    return response(view('content.usuarios.edit', [
      'usuario' => Usuario::findOrFail($id),
      'roles' => Rol::all()
    ]));

  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id_usuario)
  {

    $reglas = [
      'id_usuario' => 'required',
      'nom_usuario' => 'required',
      'ape_usuario' => 'required',
      'nick_usuario' => 'required|unique:usuario,nick_usuario,' . $id_usuario . ',id_usuario',
      'email_usuario' => 'required|email|unique:usuario,email_usuario,' . $id_usuario . ',id_usuario',
      'id_rol' => 'required|exists:rol,id_rol',
    ];

    $request->validate($reglas, Usuario::$messages);

    $usuario = Usuario::findOrFail($id_usuario);

    $usuario->fill($request->all());

    if ($usuario->save()) {
      return ['success' => true];
    }

    return ['success' => false];
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }

  public function cambiarCredenciales(int $id_usuario)
  {
    return response(view('content.usuarios.cambiarClave', [
      'usuario' => Usuario::findOrFail($id_usuario)
    ]));
  }

  public function cambiarEstado(Request $request)
  {
    $usuario = Usuario::findOrFail($request->id_usuario);
    $usuario->estado_usuario = $request->estado_usuario;

    if ($usuario->save()) {
      return ['success' => true];
    }

    return ['success' => false];
  }


  public function cambiarClave(Request $request)
  {
    // Verifica que la clave actual encriptada sea igual a la que se encuentra en la base de datos
    $request->validate([
      'id_usuario' => 'required',
      'clave_usuario' => 'required'
    ], [
      'clave_actual.required' => 'La contraseña actual es requerida',
      'clave_usuario.required' => 'La contraseña es requerida'
    ]);

    $usuario = Usuario::findOrFail($request->id_usuario);

    $clave = md5($request->clave_usuario);

    if ($usuario->clave_usuario != $clave) {
      // Retornar error
      return ['success' => false, 'message' => 'La contraseña actual es incorrecta.'];
    }

    $usuario->clave_usuario = md5($request->clave_nueva);

    if ($usuario->save()) {
      return ['success' => true];
    }

    return ['success' => false];
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
    } else {
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

        $output .= '</div>
                          </div>
                        </td>
                      </tr>';

        $contador++;
      }
    }
    return response($output);
  }

  public function generarClave()
  {
    $longitud = 12;
    $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890$&%#@!?*";
    $longitudCadena = strlen($cadena);
    $clave = "";
    for ($i = 1; $i <= $longitud; $i++) {
      $pos = rand(0, $longitudCadena - 1);
      $clave .= substr($cadena, $pos, 1);
    }
    return $clave;
  }

}
