<?php

namespace App\Notifications;

use App\Comment;
use App\Domain\Telegram\Action\EscapeMarkdownCharactersAction;
use App\News;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewsCommentedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public News $news, public Comment $comment) {}

    public function toTelegram()
    {
        $escape = app(EscapeMarkdownCharactersAction::class);

        $url = $escape->execute(url($this->news->www("#comment-{$this->comment->id}")));
        $text = $escape->execute(html_entity_decode($this->comment->html));
        $user = $escape->execute($this->comment->user->publicName());
        $title = $escape->execute($this->news->title);

        return "💬 *{$user}* комментирует новость *{$title}*\n{$url}\n\n{$text}";
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
