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

// TREE - ARBOL DE RIESGOS
Route::get('/tree/tree', 'TreeController@viewTree')->name('tree');


// USERS
Route::get('/user/us_viewModificar', 'UserController@viewModificar')->name('us_viewModificar');
Route::post('/user/us_viewModificar', 'UserController@modificar')->name('us_modificar');


// PAG DE BIENVENIDA
Route::get('/', function () {
    return view('welcome');
});


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
