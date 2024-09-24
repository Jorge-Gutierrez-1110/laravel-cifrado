<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\CookieController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::view('/plantilla','/plantilla/layout');
// Route::view('/sesiones/crear', '/sesiones/create');
// Route::view('sesiones/listado', '/sesiones/index');

Route::get('sesiones/listado', [SesionController::class, 'index']);

Route::get('/sesiones/crear', [SesionController::class, 'create']);
Route::post('/sesiones/guardar', [SesionController::class, 'store']);

Route::get('/sesiones/editar/{pos}', [SesionController::class, 'edit']);
Route::put('/sesiones/actualizar/{pos}', [SesionController::class, 'update']);

Route::get('/sesiones/mostrar/{pos}', [SesionController::class, 'show']);
Route::delete('/sesiones/borrar/{pos}', [SesionController::class, 'destroy']);

Route::get('/sesiones/vaciar', [SesionController::class, 'vaciar']);

//separacion de practicas

Route::get('/cookies/listado', [CookieController::class, 'index']);

Route::get('/cookies/crear', [CookieController::class, 'create']);
Route::post('/cookies/guardar', [CookieController::class, 'store']);

Route::get('/cookies/editar/{pos}', [CookieController::class, 'edit']);
Route::put('/cookies/actualizar/{pos}', [CookieController::class, 'update']);

Route::get('/cookies/mostrar/{pos}', [CookieController::class, 'show']);
Route::delete('/cookies/borrar/{pos}', [CookieController::class, 'destroy']);

Route::get('/cookies/vaciar', [CookieController::class, 'vaciar']);
