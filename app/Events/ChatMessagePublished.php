<?php

namespace App\Events;

use App\ChatMessage;

class ChatMessagePublished extends Event
{
    public function __construct(public ChatMessage $chatMessage)
    {
    }
}
