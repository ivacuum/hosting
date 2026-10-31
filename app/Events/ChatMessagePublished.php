<?php

namespace App\Events;

use App\Models\ChatMessage;

class ChatMessagePublished
{
    public function __construct(public ChatMessage $chatMessage) {}
}
