<?php

namespace App\Events;

use App\Message;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class NewMessage implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('conversation.' . $this->message->Conversation->id);
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message->message,
            'from_user_id' => $this->message->from_user_id,
            'is_read' => $this->message->is_read,
            'user' => [
                'firstname' => $this->message->User->firstname,
                'lastname' => $this->message->User->lastname,
                'profile_picture_url' => $this->message->User->profile_picture_url
            ]
        ];
    }
}
