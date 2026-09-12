<?php

namespace App\Notifications;

use App\ChatMessage;
use App\Domain\Telegram\Action\EscapeMarkdownCharactersAction;
use App\Domain\Telegram\Channel\TelegramAdminChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ChatMessagePublishedAdminNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(private ChatMessage $chatMessage) {}

    public function toTelegram(): string
    {
        $escape = app(EscapeMarkdownCharactersAction::class);

        $text = $escape->execute(htmlspecialchars_decode($this->chatMessage->text, ENT_QUOTES));
        $author = $escape->execute($this->chatMessage->user->publicName());

        return "💬 Сообщение в чат от {$author}\n{$text}";
    }

    public function via(): array
    {
        return [TelegramAdminChannel::class];
    }
}
