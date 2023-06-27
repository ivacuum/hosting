<?php

namespace App\Events;

use App\ChatMessage;
use Illuminate\Queue\SerializesModels;

/**
 * Написано сообщение в чате
 */
class ChatMessageCreated extends Event
{
    use SerializesModels;

    public function __construct(public ChatMessage $chatMessage)
    {
    }
}
