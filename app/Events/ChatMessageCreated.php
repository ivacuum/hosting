<?php namespace App\Events;

use App\ChatMessage;
use Illuminate\Queue\SerializesModels;

/**
 * Комментарий опубликован
 *
 * @property \App\ChatMessage $chat_message
 */
class ChatMessageCreated extends Event
{
    use SerializesModels;

    public $chat_message;

    public function __construct(ChatMessage $chat_message)
    {
        $this->chat_message = $chat_message;
    }
}
