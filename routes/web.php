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

Route::get('/', function () {
		return 'index page';
});

Route::get('/doctor/login','Doctor\LoginController@showLoginForm' );
Route::post('/doctor/login','Doctor\LoginController@login');

Route::group( ['middleware' => 'auth_doctor'], function() {
  Route::get('/doctor/logout','Doctor\LoginController@logout' );
  Route::get('/doctor/home','Doctor\DoctorController@home' );
} );

