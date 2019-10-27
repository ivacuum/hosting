<?php namespace Tests\Feature;

use App\Comment;
use App\Notifications\NewsCommentedNotification;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    use DatabaseTransactions;

    public function testNewsCommentedNotificationInList()
    {
        /** @var Comment $comment */
        $comment = factory(Comment::class)->state('news')->create();
        $notifiable = factory(User::class)->create();

        \Notification::send($notifiable, new NewsCommentedNotification($comment->rel, $comment));

        $this->be($notifiable)
            ->get('notifications')
            ->assertStatus(200);
    }
}
