<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', 'LoginController@login');
Route::post('refresh', 'LoginController@refresh');

// Protected Route
Route::group(['prefix' => 'v1/user','middleware' => 'auth:api'], function() {
    Route::get('/', 'UserController@index');
});
