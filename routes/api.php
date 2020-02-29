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

Route::group([
	'middleware' => 'auth:api'
], function() {
    Route::get('/users/{type?}/{skill?}', 'UserController@index');

    Route::get('/user/{user}', 'UserController@show');
    Route::put('/user/{id}', 'UserController@update');
    Route::get('/profile', 'UserController@loggedInUserInfo');
    Route::put('/user-location', 'UserController@updateLocation');

    Route::middleware('auth:api')->get('/skills', 'SkillController@index');

    Route::get('/conversations', 'ConversationController@index');
    Route::get('/conversation/{id}', 'ConversationController@show');
    Route::post('/message', 'ConversationController@store');
    // Route::get('/try', 'ConversationController@try');

    Route::post('/transaction', 'TransactionController@store');
    Route::get('/transactions', 'TransactionController@index');
    Route::get('/transaction/{transaction}', 'TransactionController@show');
    Route::put('/transaction/{transaction}', 'TransactionController@update');
    Route::put('/transaction/updatestatus/{transaction}', 'TransactionController@updateTransactionStatus');
});

Route::post('/user/register', 'UserController@store');





