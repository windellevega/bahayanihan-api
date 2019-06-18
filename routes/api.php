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

/**
 * -------------------------------------------------------------------------
 * User Routes
 * -------------------------------------------------------------------------
 */
//Route::middleware('auth:api')->get('/users', 'UserController@index');
Route::middleware('auth:api')->get('/users/{type?}', 'UserController@index');
Route::post('/user/register', 'UserController@store');
Route::middleware('auth:api')->get('/user/{id}', 'UserController@show');
Route::middleware('auth:api')->put('/user/{id}', 'UserController@update');



