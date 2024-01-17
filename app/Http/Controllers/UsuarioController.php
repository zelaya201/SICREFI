<?php

namespace App\Http\Controllers;

use App\Models\Credito;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

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

      $request->session()->flash('success', 'El usuario se ha registrado correctamente.');

      $subject = 'Bienvenido a SICREFI';

      $msg = '<div style="background-color: #f5f5f5; padding: 20px; font-family: Arial, Helvetica, sans-serif; color: #000000;">
                <div style="background-color: #ffffff; padding: 20px; border-radius: 10px;">
                  <div style="text-align: center;">
                    <img src="https://i.ibb.co/0jZQYQg/logo.png" alt="Logo" width="200px">
                  </div>
                  <h1 style="text-align: center; color: #000000;">Bienvenido a SICREFI</h1>
                  <p style="text-align: justify; color: #000000;">Hola <strong>' . $usuario->nom_usuario . '</strong>, te damos la bienvenida a SICREFI, tu sistema de gestión de créditos.</p>
                  <p style="text-align: justify; color: #000000;">A continuación te proporcionamos tus credenciales de acceso:</p>
                  <ul style="text-align: justify; color: #000000;">
                    <li><strong>Usuario:</strong> ' . $usuario->nick_usuario . '</li>
                    <li><strong>Contraseña:</strong> ' . $clave . '</li>
                  </ul>
                  <p style="text-align: justify; color: #000000;">Te recomendamos cambiar tu contraseña una vez que hayas iniciado sesión.</p>
                  <p style="text-align: justify; color: #000000;">Si tienes alguna duda o consulta, no dudes en contactarnos.</p>
                  <p style="text-align: justify; color: #000000;">Saludos cordiales,</p>
                  <p style="text-align: justify; color: #000000;">Equipo de SICREFI</p>
                </div>
              </div>';

      return ['success' => $this->smtp_mailer($usuario->email_usuario, $subject, $msg)];
    }

    return ['success' => false];
  }

  function smtp_mailer($to, $subject, $msg)
  {
    $mail = new PHPMailer(true);

    try {
      //Server settings
      $mail->SMTPDebug = 0;                      // Enable verbose debug output
      $mail->isSMTP();                                            // Send using SMTP
      $mail->Host = env('MAIL_HOST');                    // Set the SMTP server to send through
      $mail->SMTPSecure = 'TLS';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
      $mail->CharSet = 'UTF-8';
      $mail->IsHTML(true);
      $mail->SMTPAuth = true;                                   // Enable SMTP authentication
      $mail->Username = env('MAIL_USERNAME');                     // SMTP username
      $mail->Password = env('MAIL_PASSWORD');                               // SMTP password
      $mail->Port = 587;                                    // TCP port to connect to

      //Recipients
      $mail->setFrom('support@safeboxsv.tech', 'SafeBox');
      $mail->addAddress($to);     // Add a recipient

      // Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = $subject;
      $mail->Body = $msg;

      $mail->send();
      return true;
    } catch (Exception $e) {
      return false;
    }
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
      $request->session()->flash('success', 'El usuario se ha actualizado correctamente.');
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

      Session::flash('success', 'El estado del usuario se ha actualizado correctamente.');

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

      Session::flash('success', 'La contraseña se ha actualizado correctamente.');

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
