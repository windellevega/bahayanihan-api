<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public function Messages()
    {
        return $this->hasMany('App\Message');
    }

    public function Users()
    {
        return $this->belongsToMany('App\User', 'user_conversations', 'conversation_id', 'user_id');
    }

    public function latestMessage()
    {
        return $this->hasOne('App\Message')->latest();
    }
}
