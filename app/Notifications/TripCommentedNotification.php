<?php

namespace App\Notifications;

use App\Comment;
use App\Domain\Telegram\Action\EscapeMarkdownCharactersAction;
use App\Trip;
use App\User;
use Illuminate\Notifications\Notification;

class TripCommentedNotification extends Notification
{
    public function __construct(public Trip $trip, public Comment $comment) {}

    public function toTelegram()
    {
        $escape = app(EscapeMarkdownCharactersAction::class);

        $url = $escape->execute(url($this->trip->www("#comment-{$this->comment->id}")));
        $text = $escape->execute(html_entity_decode($this->comment->html));
        $user = $escape->execute($this->comment->user->publicName());
        $title = $escape->execute("{$this->trip->title} · {$this->trip->localizedDate()}");

        return "💬 *{$user}* комментирует поездку *{$title}*\n{$url}\n\n{$text}";
    }

    public function via(User $notifiable)
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
