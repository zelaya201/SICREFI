<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\NegocioController;
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
