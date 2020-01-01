<?php namespace App\Events;

use App\ChatMessage;
use Illuminate\Queue\SerializesModels;

/**
 * Написано сообщение в чате
 */
class ChatMessageCreated extends Event
{
    use SerializesModels;

    public ChatMessage $chatMessage;

    public function __construct(ChatMessage $chatMessage)
    {
        $this->chatMessage = $chatMessage;
    }
}
