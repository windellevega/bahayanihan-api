<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Conversation extends Model
{
    public function Messages()
    {
        return $this->hasMany('App\Message')
                ->orderBy('created_at');
    }

    public function Users()
    {
        return $this->belongsToMany('App\User', 'user_conversations', 'conversation_id', 'user_id');
    }

    public function latestMessage()
    {
        return $this->hasOne('App\Message')
                ->latest();
    }

    public function unreadMessages()
    {
        return $this->hasMany('App\Message')
                ->where('from_user_id', '<>', Auth::id())
                ->where('is_read', false);
    }
}
