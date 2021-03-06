<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

use App\Models\Conversation;
use App\Models\Transaction;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('conversation.{id}', function ($user, $id) {
    return $id == Conversation::where('id', $id)
                            ->whereHas('Users', function($q) use ($user) {
                                $q->where('user_id', $user->id);
                            })
                            ->first()
                            ->id;
});

Broadcast::channel('message-log.{id}', function ($user, $id) {
    return $id == $user->id;
});

Broadcast::channel('transactions.{id}', function ($user, $id) {
    return $user->id == Transaction::where('worker_id', $id)
                            ->first()
                            ->worker_id;
});