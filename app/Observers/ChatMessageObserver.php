<?php

namespace App\Observers;

use App\Models\ChatMessage;
use Illuminate\Support\Str;

class ChatMessageObserver
{
    public function saving(ChatMessage $chatMessage): void
    {
        $this->maintainConsistency($chatMessage);
    }

    private function maintainConsistency(ChatMessage $chatMessage): void
    {
        $chatMessage->text = Str::trim($chatMessage->text);
    }
}
