<?php

use Illuminate\Http\Request;

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

Route::post('/patient/login', 'Patient\AuthApiController@login');

Route::group([
    'middleware' => 'auth:patient_api',
], function () {

    // Authentication Routes...
    Route::get('/patient/logout', 'Patient\AuthApiController@logout');

    Route::get('/patient/home', 'Patient\AuthApiController@home');


});
