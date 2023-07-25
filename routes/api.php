<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Persona;
use App\Http\Controllers\UsuarioController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('datos/personas', function(){
    return Persona::all();
});

Route::post('/login', 'App\Http\Controllers\UsuarioController@login');
Route::post('/programaciones', 'App\Http\Controllers\UsuarioController@programacionestecnico');
Route::post('/iniciarProgramacion', 'App\Http\Controllers\UsuarioController@iniciarProgramacion');
Route::post('/finalizarProgramacion', 'App\Http\Controllers\UsuarioController@finalizarProgramacion');

