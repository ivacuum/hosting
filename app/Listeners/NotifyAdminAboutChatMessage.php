<?php

namespace App\Listeners;

use App\Events\ChatMessagePublished;
use App\Notifications\ChatMessagePublishedAdminNotification;

class NotifyAdminAboutChatMessage
{
    public function handle(ChatMessagePublished $event): void
    {
        $chatMessage = $event->chatMessage;

        if ($chatMessage->user->isRoot()) {
            return;
        }

        $chatMessage->notify(new ChatMessagePublishedAdminNotification($chatMessage));
    }
}
