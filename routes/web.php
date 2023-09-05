<?php

use App\Http\Controllers\ClienteController;
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

// Cliente Route
Route::resource('clientes',ClienteController::class);

// Negocio Route
Route::get('/clientes/negocios/negocio', $controller_path . '\Negocio@index')->name('negocios');

// Bien Route
