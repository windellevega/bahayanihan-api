<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Conversation extends Model
{
    public function messages()
    {
        return $this->hasMany(Message::class)
                ->orderBy('created_at');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_conversations', 'conversation_id', 'user_id')
                ->withTimestamps();
    }

    public function latestMessage()
    {
        return $this->hasOne(Message::class)
                ->latest();
    }

    public function unreadMessages()
    {
        return $this->hasMany(Message::class)
                ->where('from_user_id', '<>', Auth::id())
                ->where('is_read', false);
    }
}
