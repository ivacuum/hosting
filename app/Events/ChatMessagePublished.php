<?php

namespace App\Events;

use App\ChatMessage;

class ChatMessagePublished
{
    public function __construct(public ChatMessage $chatMessage) {}
}
