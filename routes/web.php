<?php

use App\Http\Controllers\BienController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\NegocioController;
use App\Http\Controllers\ReferenciaController;
use App\Http\Controllers\TelefonoClienteController;
use App\Http\Controllers\TelefonoConyugeController;
use App\Http\Controllers\TelefonoNegocioController;
use App\Http\Controllers\TelefonoReferenciaController;
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

Route::get('/', function () {
    return view('content.index');
})->name('inicio');

// Negocio Route
Route::resource('negocios', NegocioController::class);

// Referencia Route
Route::resource('referencias',ReferenciaController::class);

// Cliente Route
Route::resource('clientes',ClienteController::class);

// Bien Route
Route::resource('bienes',BienController::class);

// Telefono Cliente Route
Route::resource('telsCliente', TelefonoClienteController::class);

// Telefono Conyuge Route
Route::resource('telsConyuge', TelefonoConyugeController::class);

// Telefono Negocio Route
Route::resource('telsNegocio', TelefonoNegocioController::class);

// Telefono Referencia Route
Route::resource('telsReferencia', TelefonoReferenciaController::class);
