<?php

namespace App\Listeners;

use App\Events\ChatMessagePublished;
use App\Notifications\ChatMessagePublishedAdminNotification;

class NotifyAdminAboutChatMessageListener
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
