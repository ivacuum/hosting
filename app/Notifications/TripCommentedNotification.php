<?php

namespace App\Notifications;

use App\Comment;
use App\Domain\Life\Models\Trip;
use App\Domain\Telegram\Action\EscapeMarkdownCharactersAction;
use App\Domain\Telegram\Channel\TelegramChannel;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class TripCommentedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Trip $trip, public Comment $comment) {}

    public function toTelegram(): string
    {
        $escape = app(EscapeMarkdownCharactersAction::class);

        $url = $escape->execute(url($this->trip->www("#comment-{$this->comment->id}")));
        $text = $escape->execute(html_entity_decode($this->comment->html));
        $user = $escape->execute($this->comment->user->publicName());
        $title = $escape->execute("{$this->trip->title} · {$this->trip->localizedDate()}");

        return "💬 *{$user}* комментирует поездку *{$title}*\n{$url}\n\n{$text}";
    }

    public function via(User $notifiable): array
    {
        if ($notifiable->id === $this->comment->user_id) {
            return [];
        }

        if ($notifiable->telegram_id) {
            return [TelegramChannel::class];
        }

        return [];
    }
}
