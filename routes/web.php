<?php

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


// AUTENTICACION 
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register')->name('post.register');
// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
// Auth::routes();


// PAG DE INICIO DE SESIÓN
Route::get('/home', 'HomeController@index')->name('home');


// PAG DE BIENVENIDA
Route::get('/', function () {
    return view('welcome');
});


// TREE - ARBOL DE RIESGOS
Route::get('/tree/tree', 'TreeController@viewTree')->name('tree');


// USERS
Route::get('/user/us_viewModificar', 'UserController@viewModificar')->name('us_viewModificar');
Route::post('/user/us_viewModificar', 'UserController@modificar')->name('us_modificar');


// DOMINIO
Route::get('/dominio/dom_viewAlta', 'DominioController@viewDominio')->name('dom_viewAlta');
Route::post('/dominio/dom_viewAlta', 'DominioController@altaDominio')->name('dom_alta');
Route::get('/dominio/dom_viewModificar', 'DominioController@viewModificar')->name('dom_viewModificar');
Route::post('/dominio/dom_viewModificar', 'DominioController@modificar')->name('dom_modificar');


// PROCESO
Route::get('/proceso/proc_viewAlta', 'ProcesoController@viewProceso')->name('proc_viewAlta');
Route::post('/proceso/proc_viewAlta', 'ProcesoController@altaProceso')->name('proc_alta');
Route::get('/proceso/proc_viewModificar', 'ProcesoController@viewModificar')->name('proc_viewModificar');
Route::post('/proceso/proc_viewModificar', 'ProcesoController@modificar')->name('proc_modificar');


// SUBPROCESO
Route::get('/subproceso/subp_viewAlta', 'SubprocesoController@viewSubproceso')->name('subp_viewAlta');
Route::post('/subproceso/subp_viewAlta', 'SubprocesoController@altaSubproceso')->name('subp_alta');
Route::get('/subproceso/subp_viewModificar', 'SubprocesoController@viewModificar')->name('subp_viewModificar');
Route::post('/subproceso/subp_viewModificar', 'SubprocesoController@modificar')->name('subp_modificar');



// RIESGO
Route::get('/riesgo/rgo_viewAlta', 'RiesgoController@viewRiesgo')->name('rgo_viewAlta');
Route::post('/riesgo/rgo_viewAlta', 'RiesgoController@altaRiesgo')->name('rgo_alta');
Route::get('/riesgo/rgo_viewModificar', 'RiesgoController@viewModificar')->name('rgo_viewModificar');
Route::post('/riesgo/rgo_viewModificar', 'RiesgoController@modificar')->name('rgo_modificar');
// CONTROL
Route::get('/control/cont_viewAlta', 'ControlController@viewControl')->name('cont_viewAlta');
Route::post('/control/cont_viewAlta', 'ControlController@altaControl')->name('cont_alta');
Route::get('/control/cont_viewModificar/{riesgo}/{cont_id}', 'ControlController@viewModificar')->name('cont_viewModificar');
Route::post('/control/cont_modificar', 'ControlController@post')->name('cont_modificar');
// ACTIVIDAD
Route::get('/actividad/act_viewAlta', 'ActividadController@viewActividad')->name('act_viewAlta');
Route::post('/actividad/act_viewAlta', 'ActividadController@altaActividad')->name('act_alta');
Route::get('/actividad/act_viewModificar/{riesgo}/{act_id}', 'ActividadController@viewModificar')->name('act_viewModificar');
Route::post('/actividad/act_viewModificar', 'ActividadController@modificar')->name('act_modificar');