<?php

namespace App\Listeners;

use App\Events\ChatMessageCreated;
use Ivacuum\Generic\Listeners\TelegramNotifier;

class TelegramChatMessage extends TelegramNotifier
{
    public function handle(ChatMessageCreated $event)
    {
        $model = $event->chatMessage;

        if ($model->user->isRoot() || \App::runningInConsole()) {
            return;
        }

        $text = "💬 Сообщение в чат от {$model->user->publicName()}\n" . htmlspecialchars_decode($model->text, ENT_QUOTES);

        $this->telegram->notifyAdmin($text);
    }
}
