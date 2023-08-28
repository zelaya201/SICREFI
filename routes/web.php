<?php

use App\Http\Controllers\Cliente;
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
Route::resource('clientes',Cliente::class);

// Negocio Route
Route::get('/clientes/negocios/negocio', $controller_path . '\Negocio@index')->name('negocios');

