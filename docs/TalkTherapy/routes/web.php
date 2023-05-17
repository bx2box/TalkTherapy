<?php

use Illuminate\Support\Facades\Route;

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
//Ruta registrarse usuarios
Route::get('/register', 'App\Http\Controllers\UsuarioController@showRegisterForm')->name('register');
Route::post('/register', 'App\Http\Controllers\UsuarioController@register');

//Ruta registrarse psicólogos
Route::get('/registerP', 'App\Http\Controllers\PsicologoController@showRegisterForm')->name('registerP');
Route::post('/registerP', 'App\Http\Controllers\PsicologoController@registerP');

//Ruta iniciar sesión usuarios
Route::get('/login', 'App\Http\Controllers\UsuarioController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\UsuarioController@login');

//Ruta iniciar sesión psicólogos
Route::get('/loginP', 'App\Http\Controllers\PsicologoController@showLoginForm')->name('loginP');
Route::post('/loginP', 'App\Http\Controllers\PsicologoController@loginP');

//Ruta cerrar sesión
Route::post('/logout', 'App\Http\Controllers\UsuarioController@logout')->name('logout');

//Ruta videollamada
Route::get('/videocall', 'App\Http\Controllers\VideoCallController@index')->name('videocall');



Route::middleware(['auth'])->group(function () {
    //Rutas para los usuarios
    Route::get('/usuario', 'App\Http\Controllers\UsuarioController@index')->name('usuario.index');
    Route::post('/usuario', 'App\Http\Controllers\UsuarioController@index');
    Route::get('/citas', 'App\Http\Controllers\UsuarioController@reservarCita')->name('usuario.citas');
    Route::post('/citas', 'App\Http\Controllers\UsuarioController@reservarCita');
    Route::get('/Vistacitas', 'App\Http\Controllers\UsuarioController@citas')->name('usuario.Vistacitas');
    Route::post('/Vistacitas', 'App\Http\Controllers\UsuarioController@citas');
});

Route::middleware(['auth:psicologo'])->group(function () {
    //Rutas para los psicologos
    Route::get('/psicologo', 'App\Http\Controllers\PsicologoController@index')->name('psicologo.index');
    Route::post('/psicologo', 'App\Http\Controllers\PsicologoController@index');

});
