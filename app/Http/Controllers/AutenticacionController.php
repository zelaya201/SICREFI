<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class AutenticacionController extends Controller
{
  public function login()
  {

    if(Session::has('id_usuario')){
      return redirect()->route('inicio');
    }

    return view('content.authentications.login');
  }

  public function postLogin(Request $request)
  {
    $request->validate([
      'email-username' => 'required',
      'password' => 'required',
    ], [
      'email-username.required' => 'Complete todos los campos.',
      'password.required' => 'Complete todos los campos.',
    ]);

    $credentials = [
      'email_usuario' => $request->input('email-username'),
      'clave_usuario' => md5($request->input('password')),
    ];

    $usuario = Usuario::query()
      ->where('email_usuario', $credentials['email_usuario'])
      ->where('clave_usuario', $credentials['clave_usuario'])
      ->where('estado_usuario', 'Activo')
      ->first();

    if ($usuario) {
      $usuario->load('rol');

      session([
        'usuario' => $usuario->nick_usuario,
        'id_usuario' => $usuario->id_usuario,
        'nombre' => $usuario->nom_usuario,
        'apellido' => $usuario->ape_usuario,
        'email' => $usuario->email_usuario,
        'rol' => $usuario->rol->nom_rol,
      ]);

      return redirect()->route('inicio');
    }else{
      $usuario = Usuario::query()
        ->where('nick_usuario', $credentials['email_usuario'])
        ->where('clave_usuario', $credentials['clave_usuario'])
        ->where('estado_usuario', 'Activo')
        ->first();

      if ($usuario) {
        $usuario->load('rol');

        session([
          'usuario' => $usuario->nick_usuario,
          'id_usuario' => $usuario->id_usuario,
          'nombre' => $usuario->nom_usuario,
          'apellido' => $usuario->ape_usuario,
          'email' => $usuario->email_usuario,
          'rol' => $usuario->rol->nom_rol,
        ]);

        return redirect()->route('inicio');
      }
    }

    return back()->withErrors([
      'email-username' => 'Usuario y/o contraseña son incorrectas.',
    ])->withInput($request->only('email-username'));
  }

  public function logout()
  {
    Session::flush();
    return redirect()->route('login')->with('success', 'Se ha cerrado la sesión correctamente.');
  }

  public function updatePassword(Request $request)
  {
    $request->validate([
      'password' => 'required',
      'password_confirmation' => 'required|same:password',
    ]);

    $usuario = Usuario::query()->where('token_usuario', $request->token)->first();

    if ($usuario) {
      $usuario->clave_usuario = md5($request->password);
      $usuario->token_usuario = null;

      if($usuario->save()){
        return redirect()->route('login')->with('success', 'Se ha restablecido la contraseña correctamente.');
      }

      return back()->with('error', 'Ha ocurrido un error al restablecer la contraseña.');
    }

    return redirect()->route('login')->with('error', 'El token proporcionado no es válido.');
  }

  public function resetPassword()
  {
    return view('content.authentications.reset-password');
  }

  public function changePassword()
  {

    global $request;
    $usuario = Usuario::query()->where('token_usuario', $request->token)->first();

    if ($usuario) {
      $token = $usuario->token_usuario;
      return view('content.authentications.change-password', ['token' => $token]);
    }

    return redirect()->route('login')->with('error', 'El token proporcionado no es válido.');
  }

  public function sendMail(Request $request): \Illuminate\Http\RedirectResponse
  {
    $request->validate([
      'email_usuario' => ['required', 'email']
    ],
      [
        'email_usuario.required' => 'Por favor ingrese un correo electrónico.',
        'email_usuario.email' => 'Por favor ingrese un correo electrónico válido.'
      ]
    );

    $user = Usuario::query()
      ->where('email_usuario', $request->email_usuario)
      ->first();

    if ($user) {
      $token = encrypt($user->email_usuario . $user->pass_usuario);
      $user->token_usuario = $token;
      $user->save();

      $url = route('changePassword', ['token' => $token]);

      // Agregar logo de SafeBox
      $urlLogo = '';

      $msg = "<div style='background-color: #f5f5f5; padding: 20px;'>";
      $msg .= "<div style='background-color: #fff; border-radius: 5px; padding: 20px;'>";
      $msg .= "<h1 style='color: #217373; font-size: 30px; font-weight: 600; margin-bottom: 20px;'>¡Hola, {$user->nom_usuario} {$user->ape_usuario}!</h1>";
      $msg .= "<p style='font-size: 16px; margin-bottom: 20px;'>Hemos recibido una solicitud para restablecer la contraseña de tu cuenta.</p>";
      $msg .= "<p style='font-size: 16px; margin-bottom: 20px;'>Si no has realizado esta solicitud, puedes ignorar este correo electrónico.</p>";
      $msg .= "<p style='font-size: 16px; margin-bottom: 20px;'>Si deseas restablecer tu contraseña, haz clic en el siguiente enlace:</p>";

      // Crear botón para restablecer contraseña con estilo de CSS
      $msg .= "<a href='{$url}' style='background-color: #217373; border: none; border-radius: 5px; color: #fff; cursor: pointer; display: inline-block; font-size: 16px; font-weight: 600; margin-bottom: 20px; padding: 10px 20px; text-decoration: none;'>Restablecer contraseña</a>";

      $this->smtp_mailer($user->email_usuario, 'Restablecer contraseña', $msg);

      return redirect()->route('login')->with('success', 'Se ha enviado un correo electrónico con las instrucciones para restablecer la contraseña.');
    }

    return back()->withErrors([
      'email_usuario' => 'No se ha encontrado ningún usuario con el correo electrónico proporcionado.',
    ]);

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
      $mail->setFrom('support@sicrefisv.tech', 'SICREFI');
      $mail->addAddress($to);     // Add a recipient

      // Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = $subject;
      $mail->Body = $msg;

      $mail->send();
      return 'Sent';
    } catch (Exception $e) {
      return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  }
}
