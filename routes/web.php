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

Route::get('/doctor/login', function () {
		return View::make('doctor.doctor_login');
});

Route::post('/doctor/login','DoctorController@login');
?>
