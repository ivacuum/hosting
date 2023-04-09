<?php namespace App\Observers;

use App\ChatMessage;
use App\Events\ChatMessageCreated;

class ChatMessageObserver
{
    public function created(ChatMessage $chatMessage)
    {
        event(new ChatMessageCreated($chatMessage));
    }
}
