<?php namespace App\Events;

use App\ChatMessage;
use Illuminate\Queue\SerializesModels;

/**
 * Комментарий опубликован
 */
class ChatMessageCreated extends Event
{
    use SerializesModels;

    public $chatMessage;

    public function __construct(ChatMessage $chatMessage)
    {
        $this->chatMessage = $chatMessage;
    }
}
