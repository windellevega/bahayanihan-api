<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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
    Route::get('/users/{type?}/{skill?}', [UserController::class, 'index']);

    Route::get('/user/role', [UserController::class, 'getUserRole']);
    Route::get('/user/{user}', [UserController::class, 'show']);
    Route::put('/user/{user}', [UserController::class, 'update']);
    Route::get('/profile', [UserController::class, 'LoggedInUserInfo']);
    Route::put('/user-location', [UserController::class, 'updateLocation']);

    Route::get('/skills', [SkillController::class, 'index']);
    Route::get('/skill/{skill}', [SkillController::class, 'show']);

    Route::get('/conversations', [ConversationController::class, 'index']);
    Route::get('/conversation/{id}', [ConversationController::class, 'show']);
    Route::get('/conversation-with-user/{id}', [ConversationController::class, 'showConversationWithUser']);
    Route::post('/message', [ConversationController::class, 'store']);
    Route::put('/messages/mark-as-read/{id}', [ConversationController::class, 'markMessagesAsRead']);
    Route::get('/conversations/with-unread', [ConversationController::class, 'countConversationsWithUnreadMessages']);
    
    // Route::get('/try', 'ConversationController@try');

    Route::post('/transaction', [TransactionController::class, 'store']);
    Route::get('/transactions', [TransactionController::class, 'index']);
    Route::get('/transaction/{transaction}', [TransactionController::class, 'show']);
    Route::put('/transaction/{transaction}', [TransactionController::class, 'update']);
    Route::put('/transaction/status/{transaction}', [TransactionController::class, 'updateTransactionStatus']);
});

Route::post('/user/register', [UserController::class, 'store']);





