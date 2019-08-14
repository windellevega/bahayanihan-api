<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'conversation_id', 'from_user_id',
        'message', 'is_read'
    ];

    public function User()
    {
        return $this->belongsTo('App\User', 'from_user_id');
    }

    public function Conversation()
    {
        return $this->belongsTo('App\Conversation', 'conversation_id');
    }
}
