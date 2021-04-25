<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'conversation_id', 'from_user_id',
        'message', 'is_read'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'from_user_id');
    }

    public function conversation()
    {
        return $this->belongsTo('App\Conversation', 'conversation_id');
    }
}
