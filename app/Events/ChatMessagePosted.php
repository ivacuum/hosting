<?php namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class ChatMessagePosted extends Event implements ShouldBroadcastNow
{
    public array $message;

    public function __construct(array $message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new Channel('chat');
    }
}
