<?php

namespace App\Notifications;

use App\ChatMessage;
use Illuminate\Notifications\Notification;

class ChatMessagePublishedAdminNotification extends Notification
{
    public function __construct(private ChatMessage $chatMessage) {}

    public function toTelegram(): string
    {
        $text = htmlspecialchars_decode($this->chatMessage->text, ENT_QUOTES);

        $author = $this->chatMessage->user->publicName();

        return "💬 Сообщение в чат от {$author}\n{$text}";
    }

    public function via(): array
    {
        return [TelegramAdminChannel::class];
    }
}
