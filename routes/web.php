<?php

use App\Http\Controllers\AutenticacionController;
use App\Http\Controllers\BienController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\ConyugeController;
use App\Http\Controllers\CreditoController;
use App\Http\Controllers\CuotaController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\NegocioController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ReferenciaController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\SeguridadController;
use App\Http\Controllers\TelefonoClienteController;
use App\Http\Controllers\TelefonoConyugeController;
use App\Http\Controllers\TelefonoNegocioController;
use App\Http\Controllers\TelefonoReferenciaController;
use App\Http\Controllers\UsuarioController;
use App\Models\Credito;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$controller_path = 'App\Http\Controllers';

// Index Route
Route::get('/', [IndexController::class, 'index'])->name('inicio');

Route::get('/index', [IndexController::class, 'index'])->name('inicio');

// Acerca de Route
Route::get('/acerca-de', function () {
    return view('content.acerca-de');
})->name('acerca-de');

// Autenticacion Route
Route::get('/inicioSesion', [AutenticacionController::class, 'login'])
  ->name('login');

Route::post('/inicioSesion', [AutenticacionController::class, 'postLogin'])->name('authenticate');

// Envio de correo
Route::post('/enviarCorreo', [AutenticacionController::class, 'sendMail'])->name('sendMail');

// Logout Route
Route::get('/cerrarSesion', [AutenticacionController::class, 'logout'])
  ->name('logout');

// Reset Password Route
Route::get('/reestablecerCredenciales', [AutenticacionController::class, 'resetPassword'])
  ->name('resetPassword');

// Change Password Route
Route::get('/cambiarCredenciales', [AutenticacionController::class, 'changePassword'])
  ->name('changePassword');

// Update Password Route
Route::post('/actualizarCredenciales', [AutenticacionController::class, 'updatePassword'])
  ->name('updatePassword');

// PDF Route
Route::get('generar-declaracion/{credito}', [PDFController::class, 'generarDeclaracion'])->name('generar-declaracion');
Route::get('generar-pagare/{credito}', [PDFController::class, 'generarPagare'])->name('generar-pagare');
Route::get('generar-recibo/{credito}', [PDFController::class, 'generarRecibo'])->name('generar-recibo');
Route::get('generar-tarjeta/{credito}', [PDFController::class, 'generarTarjeta'])->name('generar-tarjeta');
Route::get('generar-ticket/{credito}', [PDFController::class, 'generarTicket'])->name('generar-ticket');;

// Cuota Route
Route::get('/cuotas/pagarCredito/{credito}', [CuotaController::class, 'pagarCredito'])
  ->name('cuotas.pagarCredito');
Route::get('/cuotas/pagarCuota/{cuota}', [CuotaController::class, 'pagarCuota'])->name('cuotas.pagarCuota');
Route::get('/cuotas/posponerCuota/{cuota}', [CuotaController::class, 'posponerCuota'])->name('cuotas.posponerCuota');
Route::resource('cuotas', CuotaController::class);


// Negocio Route
Route::resource('negocios', NegocioController::class);

// Referencia Route
Route::resource('referencias',ReferenciaController::class);

// Cliente Route
Route::resource('clientes',ClienteController::class);

// Dar de alta un cliente
Route::post('/clientes/cambiarEstado/{cliente}', [ClienteController::class, 'cambiarEstado'])->name('clientes.cambiarEstado');

// Conyuge Route
Route::resource('conyuge', ConyugeController::class);

// Bien Route
Route::get('/bienes/{bien}/get', [BienController::class, 'get'])->name('bienes.get');
Route::resource('bienes',BienController::class);

// Telefono Cliente Route
Route::resource('telsCliente', TelefonoClienteController::class);

// Telefono conyuge Route
Route::resource('telsConyuge', TelefonoConyugeController::class);

// Telefono Negocio Route
Route::resource('telsNegocio', TelefonoNegocioController::class);

// Telefono Referencia Route
Route::resource('telsReferencia', TelefonoReferenciaController::class);

// Credito Route
Route::get('/creditos/calcularFechasCuotas', [CreditoController::class, 'calcularFechasCuotas'])
  ->name('creditos.calcularFechasCuotas');

Route::get('/creditos/cambiarEstado/{credito}', [CreditoController::class, 'cambiarEstado'])
  ->name('creditos.cambiarEstado');

Route::get('/creditos/search', [CreditoController::class, 'buscarCredito'])->name('creditos.search');
Route::resource('creditos', CreditoController::class);

// Usuario Route
Route::resource('usuarios', UsuarioController::class);
Route::get('/usuarios/search', [UsuarioController::class, 'buscarUsuario'])->name('usuarios.search');


Route::get('/usuarios/cambiarClave/{id}', [UsuarioController::class, 'cambiarClave'])
  ->name('usuarios.cambiarClave');

Route::get('/usuarios/cambiarCredenciales/{id}', [UsuarioController::class, 'cambiarCredenciales'])
  ->name('usuarios.cambiarCredenciales');

// Dar de baja un usuario
Route::get('/usuarios/darBaja/{usuario}', [UsuarioController::class, 'cambiarEstado'])->name('usuarios.darBaja');

// Rol Route
Route::resource('roles', RolController::class);

// Seguridad Route
Route::resource('seguridad', SeguridadController::class);

// Configuracion Route
Route::resource('configuracion', ConfiguracionController::class);

// Bitacora Route
Route::resource('bitacora', BitacoraController::class);
