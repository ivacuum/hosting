<?php

namespace App\Observers;

use App\ChatMessage;
use Illuminate\Support\Str;

class ChatMessageObserver
{
    public function saving(ChatMessage $chatMessage)
    {
        $this->maintainConsistency($chatMessage);
    }

    private function maintainConsistency(ChatMessage $chatMessage): void
    {
        $chatMessage->text = Str::trim($chatMessage->text);
    }
}
