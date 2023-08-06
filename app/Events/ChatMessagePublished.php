<?php

namespace App\Events;

use App\ChatMessage;
use Illuminate\Queue\SerializesModels;

class ChatMessagePublished extends Event
{
    use SerializesModels;

    public function __construct(public ChatMessage $chatMessage)
    {
    }
}
